export const themeStorageKey = 'newdebugbar-website-theme';

const themeModes = ['system', 'light', 'dark'];

export const resolveTheme = (themeMode, systemPrefersDark) => {
    const selectedTheme = themeModes.includes(themeMode) ? themeMode : 'system';
    const resolvedTheme = selectedTheme === 'system'
        ? (systemPrefersDark ? 'dark' : 'light')
        : selectedTheme;

    return { selectedTheme, resolvedTheme };
};

export const applyTheme = ({
    root,
    screenshots,
    storage,
    systemPrefersDark,
    themeMode,
    persist = false,
}) => {
    const { selectedTheme, resolvedTheme } = resolveTheme(themeMode, systemPrefersDark);
    const isLight = resolvedTheme === 'light';

    root.documentElement.dataset.themeMode = selectedTheme;
    root.documentElement.dataset.theme = resolvedTheme;

    root.querySelectorAll('[data-theme-option]').forEach((themeOption) => {
        const isSelected = themeOption.dataset.themeOption === selectedTheme;

        if (themeOption.hasAttribute('aria-pressed')) {
            themeOption.setAttribute('aria-pressed', String(isSelected));
        }

        if (themeOption.hasAttribute('aria-checked')) {
            themeOption.setAttribute('aria-checked', String(isSelected));
        }

        themeOption.querySelector('[data-theme-selection]')?.classList.toggle('hidden', !isSelected);
    });

    root.querySelector('meta[name="theme-color"]')?.setAttribute('content', isLight ? '#fafafa' : '#07070a');

    const requestInspectorImage = root.querySelector('[data-request-inspector-image]');
    const requestInspectorMobileSource = root.querySelector('[data-request-inspector-mobile-source]');

    if (requestInspectorImage && requestInspectorMobileSource) {
        requestInspectorImage.src = screenshots.desktop[resolvedTheme];
        requestInspectorMobileSource.srcset = screenshots.mobile[resolvedTheme];
    }

    if (persist) {
        storage.setItem(themeStorageKey, selectedTheme);
    }

    return { selectedTheme, resolvedTheme };
};

export const initializeTheme = ({ root, screenshots, storage, windowObject }) => {
    const themeOptions = [...root.querySelectorAll('[data-theme-option]')];
    const systemThemeQuery = windowObject.matchMedia('(prefers-color-scheme: dark)');

    const updateTheme = (themeMode, persist = false) => applyTheme({
        root,
        screenshots,
        storage,
        systemPrefersDark: systemThemeQuery.matches,
        themeMode,
        persist,
    });

    const optionHandlers = themeOptions.map((themeOption) => {
        const handler = () => {
            updateTheme(themeOption.dataset.themeOption, true);
        };

        themeOption.addEventListener('click', handler);

        return [themeOption, handler];
    });

    const handleSystemThemeChange = () => {
        if (root.documentElement.dataset.themeMode === 'system') {
            updateTheme('system');
        }
    };

    updateTheme(root.documentElement.dataset.themeMode);
    systemThemeQuery.addEventListener('change', handleSystemThemeChange);

    return () => {
        optionHandlers.forEach(([themeOption, handler]) => themeOption.removeEventListener('click', handler));
        systemThemeQuery.removeEventListener('change', handleSystemThemeChange);
    };
};

export const initializeMobileMenu = ({ root }) => {
    const menuRoot = root.querySelector('[data-mobile-menu-root]');
    const menu = root.querySelector('[data-mobile-menu]');
    const trigger = root.querySelector('[data-mobile-menu-trigger]');
    const openIcon = root.querySelector('[data-mobile-menu-open-icon]');
    const closeIcon = root.querySelector('[data-mobile-menu-close-icon]');

    if (!menuRoot || !menu || !trigger) {
        return () => {};
    }

    const setOpen = (isOpen, restoreFocus = false) => {
        menu.classList.toggle('hidden', !isOpen);
        trigger.setAttribute('aria-expanded', String(isOpen));
        trigger.setAttribute('aria-label', isOpen ? 'Close navigation menu' : 'Open navigation menu');
        openIcon?.classList.toggle('hidden', isOpen);
        closeIcon?.classList.toggle('hidden', !isOpen);

        if (restoreFocus) {
            trigger.focus();
        }
    };

    const handleTrigger = () => setOpen(trigger.getAttribute('aria-expanded') !== 'true');
    const handleDocumentClick = (event) => {
        if (!menuRoot.contains(event.target)) {
            setOpen(false);
        }
    };
    const handleDocumentKeydown = (event) => {
        if (event.key === 'Escape' && trigger.getAttribute('aria-expanded') === 'true') {
            setOpen(false, true);
        }
    };
    const dismissHandlers = [...menu.querySelectorAll('[data-mobile-menu-dismiss]')].map((control) => {
        const handler = () => setOpen(false);

        control.addEventListener('click', handler);

        return [control, handler];
    });

    trigger.addEventListener('click', handleTrigger);
    root.addEventListener('click', handleDocumentClick);
    root.addEventListener('keydown', handleDocumentKeydown);

    return () => {
        trigger.removeEventListener('click', handleTrigger);
        root.removeEventListener('click', handleDocumentClick);
        root.removeEventListener('keydown', handleDocumentKeydown);
        dismissHandlers.forEach(([control, handler]) => control.removeEventListener('click', handler));
    };
};

export const copyText = async (text, { root, navigatorObject }) => {
    if (navigatorObject.clipboard?.writeText) {
        await navigatorObject.clipboard.writeText(text);

        return;
    }

    const textarea = root.createElement('textarea');

    textarea.value = text;
    textarea.setAttribute('readonly', '');
    textarea.style.position = 'fixed';
    textarea.style.opacity = '0';
    root.body.append(textarea);
    textarea.select();

    const copied = root.execCommand('copy');

    textarea.remove();

    if (!copied) {
        throw new Error('Copy command was rejected');
    }
};

export const initializeCopyButtons = ({ root, navigatorObject, windowObject }) => {
    const pendingResets = new Set();
    const buttonHandlers = [...root.querySelectorAll('[data-copy-command]')].map((copyButton) => {
        const handler = async () => {
            const command = copyButton.dataset.copyCommand;
            const copyIcon = copyButton.querySelector('[data-copy-icon]');
            const successIcon = copyButton.querySelector('[data-copy-success]');
            const status = copyButton.closest('[data-copy-root]')?.querySelector('[data-copy-status]');
            const defaultLabel = copyButton.dataset.copyLabel ?? 'Copy install command';
            const successMessage = copyButton.dataset.copySuccess ?? 'Install command copied';

            try {
                await copyText(command, { root, navigatorObject });

                copyIcon?.classList.add('hidden');
                successIcon?.classList.remove('hidden');
                copyButton.setAttribute('aria-label', successMessage);

                if (status) {
                    status.textContent = successMessage;
                }

                const reset = windowObject.setTimeout(() => {
                    pendingResets.delete(reset);
                    copyIcon?.classList.remove('hidden');
                    successIcon?.classList.add('hidden');
                    copyButton.setAttribute('aria-label', defaultLabel);

                    if (status) {
                        status.textContent = '';
                    }
                }, 3000);

                pendingResets.add(reset);
            } catch {
                if (status) {
                    status.textContent = `Could not copy: ${command}`;
                }
            }
        };

        copyButton.addEventListener('click', handler);

        return [copyButton, handler];
    });

    return () => {
        buttonHandlers.forEach(([copyButton, handler]) => copyButton.removeEventListener('click', handler));
        pendingResets.forEach((reset) => windowObject.clearTimeout(reset));
    };
};

export const initializeSite = ({
    root = document,
    screenshots,
    storage = window.localStorage,
    windowObject = window,
}) => {
    const destroyTheme = initializeTheme({ root, screenshots, storage, windowObject });
    const destroyMobileMenu = initializeMobileMenu({ root });
    const destroyCopyButtons = initializeCopyButtons({
        root,
        navigatorObject: windowObject.navigator,
        windowObject,
    });

    return () => {
        destroyTheme();
        destroyMobileMenu();
        destroyCopyButtons();
    };
};
