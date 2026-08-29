import desktopDark from '../images/hero/inspector-desktop-dark.png';
import desktopLight from '../images/hero/inspector-desktop-light.png';
import mobileDark from '../images/hero/inspector-mobile-dark.png';
import mobileLight from '../images/hero/inspector-mobile-light.png';

const themeStorageKey = 'newdebugbar-website-theme';
const themeOptions = document.querySelectorAll('[data-theme-option]');
const themeMenuRoot = document.querySelector('[data-theme-menu-root]');
const themeMenu = document.querySelector('[data-theme-menu]');
const themeMenuTrigger = document.querySelector('[data-theme-menu-trigger]');
const themeColor = document.querySelector('meta[name="theme-color"]');
const heroImage = document.querySelector('[data-hero-image]');
const heroMobileSource = document.querySelector('[data-hero-mobile-source]');
const systemThemeQuery = window.matchMedia('(prefers-color-scheme: dark)');

const resolveTheme = (themeMode) => {
    if (themeMode === 'system') {
        return systemThemeQuery.matches ? 'dark' : 'light';
    }

    return themeMode;
};

const applyTheme = (themeMode, persist = false) => {
    const selectedTheme = ['system', 'light', 'dark'].includes(themeMode) ? themeMode : 'system';
    const resolvedTheme = resolveTheme(selectedTheme);
    const isLight = resolvedTheme === 'light';

    document.documentElement.dataset.themeMode = selectedTheme;
    document.documentElement.dataset.theme = resolvedTheme;

    themeOptions.forEach((themeOption) => {
        const isSelected = themeOption.dataset.themeOption === selectedTheme;

        if (themeOption.hasAttribute('aria-pressed')) {
            themeOption.setAttribute('aria-pressed', String(isSelected));
        }

        if (themeOption.hasAttribute('aria-checked')) {
            themeOption.setAttribute('aria-checked', String(isSelected));
        }

        themeOption.querySelector('[data-theme-selection]')?.classList.toggle('hidden', !isSelected);
    });

    if (themeColor) {
        themeColor.setAttribute('content', isLight ? '#fafafa' : '#07070a');
    }

    if (heroImage && heroMobileSource) {
        heroImage.src = isLight ? desktopLight : desktopDark;
        heroMobileSource.srcset = isLight ? mobileLight : mobileDark;
    }

    if (persist) {
        localStorage.setItem(themeStorageKey, selectedTheme);
    }
};

applyTheme(document.documentElement.dataset.themeMode);

const closeThemeMenu = (restoreFocus = false) => {
    themeMenu?.classList.add('hidden');
    themeMenuTrigger?.setAttribute('aria-expanded', 'false');

    if (restoreFocus) {
        themeMenuTrigger?.focus();
    }
};

themeMenuTrigger?.addEventListener('click', () => {
    const isOpen = themeMenuTrigger.getAttribute('aria-expanded') === 'true';

    themeMenu?.classList.toggle('hidden', isOpen);
    themeMenuTrigger.setAttribute('aria-expanded', String(!isOpen));
});

themeOptions.forEach((themeOption) => {
    themeOption.addEventListener('click', () => {
        applyTheme(themeOption.dataset.themeOption, true);

        if (themeOption.closest('[data-theme-menu]')) {
            closeThemeMenu(true);
        }
    });
});

document.addEventListener('click', (event) => {
    if (themeMenuRoot && !themeMenuRoot.contains(event.target)) {
        closeThemeMenu();
    }
});

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && themeMenuTrigger?.getAttribute('aria-expanded') === 'true') {
        closeThemeMenu(true);
    }
});

systemThemeQuery.addEventListener('change', () => {
    if (document.documentElement.dataset.themeMode === 'system') {
        applyTheme('system');
    }
});

const copyButton = document.querySelector('[data-copy-command]');

const copyText = async (text) => {
    if (navigator.clipboard?.writeText) {
        await navigator.clipboard.writeText(text);

        return;
    }

    const textarea = document.createElement('textarea');

    textarea.value = text;
    textarea.setAttribute('readonly', '');
    textarea.style.position = 'fixed';
    textarea.style.opacity = '0';
    document.body.append(textarea);
    textarea.select();

    const copied = document.execCommand('copy');

    textarea.remove();

    if (!copied) {
        throw new Error('Copy command was rejected');
    }
};

copyButton?.addEventListener('click', async () => {
    const command = copyButton.dataset.copyCommand;
    const copyIcon = copyButton.querySelector('[data-copy-icon]');
    const successIcon = copyButton.querySelector('[data-copy-success]');
    const status = document.querySelector('[data-copy-status]');

    try {
        await copyText(command);

        copyIcon?.classList.add('hidden');
        successIcon?.classList.remove('hidden');
        copyButton.setAttribute('aria-label', 'Install command copied');

        if (status) {
            status.textContent = 'Install command copied';
        }

        window.setTimeout(() => {
            copyIcon?.classList.remove('hidden');
            successIcon?.classList.add('hidden');
            copyButton.setAttribute('aria-label', 'Copy install command');

            if (status) {
                status.textContent = '';
            }
        }, 1800);
    } catch {
        if (status) {
            status.textContent = 'Could not copy the install command';
        }
    }
});
