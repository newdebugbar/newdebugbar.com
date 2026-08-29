import { afterEach, beforeEach, describe, expect, it, vi } from 'vitest';
import {
    copyText,
    initializeCopyButtons,
    initializeTheme,
    themeStorageKey,
} from '../../resources/js/site.js';

const screenshots = {
    desktop: {
        dark: '/desktop-dark.png',
        light: '/desktop-light.png',
    },
    mobile: {
        dark: '/mobile-dark.png',
        light: '/mobile-light.png',
    },
};

const createMediaQuery = (initialMatches = false) => {
    const listeners = new Set();

    return {
        matches: initialMatches,
        media: '(prefers-color-scheme: dark)',
        addEventListener: vi.fn((event, listener) => {
            if (event === 'change') {
                listeners.add(listener);
            }
        }),
        removeEventListener: vi.fn((event, listener) => {
            if (event === 'change') {
                listeners.delete(listener);
            }
        }),
        setMatches(matches) {
            this.matches = matches;
            listeners.forEach((listener) => listener({ matches, media: this.media }));
        },
    };
};

const mountThemeControls = () => {
    document.head.innerHTML = '<meta name="theme-color" content="#000000">';
    document.body.innerHTML = `
        <button data-theme-option="system" aria-pressed="false"><span class="hidden" data-theme-selection></span></button>
        <button data-theme-option="light" aria-pressed="false"><span class="hidden" data-theme-selection></span></button>
        <button data-theme-option="dark" aria-pressed="false"><span class="hidden" data-theme-selection></span></button>
        <div data-theme-menu-root>
            <button data-theme-menu-trigger aria-expanded="false"></button>
            <div class="hidden" data-theme-menu>
                <button data-theme-option="system" aria-checked="false"><span class="hidden" data-theme-selection></span></button>
                <button data-theme-option="light" aria-checked="false"><span class="hidden" data-theme-selection></span></button>
                <button data-theme-option="dark" aria-checked="false"><span class="hidden" data-theme-selection></span></button>
            </div>
        </div>
        <picture>
            <source data-request-inspector-mobile-source>
            <img data-request-inspector-image>
        </picture>
    `;
};

const mountCopyControl = () => {
    document.body.innerHTML = `
        <div data-copy-root>
            <button
                data-copy-command="example-command"
                data-copy-label="copy-label"
                data-copy-success="success-label"
                aria-label="copy-label"
            >
                <span data-copy-icon></span>
                <span class="hidden" data-copy-success></span>
            </button>
            <span data-copy-status></span>
        </div>
    `;
};

beforeEach(() => {
    document.documentElement.dataset.themeMode = 'system';
});

afterEach(() => {
    vi.useRealTimers();
    vi.restoreAllMocks();
    document.head.innerHTML = '';
    document.body.innerHTML = '';
    document.documentElement.removeAttribute('data-theme');
    document.documentElement.removeAttribute('data-theme-mode');
    delete document.execCommand;
});

describe('theme controls', () => {
    it('resolves system mode and applies the matching screenshot assets', () => {
        mountThemeControls();

        const mediaQuery = createMediaQuery(false);
        const storage = { setItem: vi.fn() };
        const destroy = initializeTheme({
            root: document,
            screenshots,
            storage,
            windowObject: {
                matchMedia: vi.fn(() => mediaQuery),
            },
        });

        expect(document.documentElement.dataset.theme).toBe('light');
        expect(document.querySelector('meta[name="theme-color"]').content).toBe('#fafafa');
        expect(document.querySelector('[data-request-inspector-image]').getAttribute('src')).toBe('/desktop-light.png');
        expect(document.querySelector('[data-request-inspector-mobile-source]').getAttribute('srcset')).toBe('/mobile-light.png');
        expect(document.querySelector('[data-theme-option="system"][aria-pressed]').getAttribute('aria-pressed')).toBe('true');

        document.querySelector('[data-theme-option="dark"][aria-pressed]').click();

        expect(document.documentElement.dataset.themeMode).toBe('dark');
        expect(document.documentElement.dataset.theme).toBe('dark');
        expect(document.querySelector('meta[name="theme-color"]').content).toBe('#07070a');
        expect(document.querySelector('[data-request-inspector-image]').getAttribute('src')).toBe('/desktop-dark.png');
        expect(storage.setItem).toHaveBeenCalledWith(themeStorageKey, 'dark');

        destroy();
        expect(mediaQuery.removeEventListener).toHaveBeenCalledOnce();
    });

    it('closes the mobile menu and follows system changes only in system mode', () => {
        mountThemeControls();

        const mediaQuery = createMediaQuery(false);
        const trigger = document.querySelector('[data-theme-menu-trigger]');
        const menu = document.querySelector('[data-theme-menu]');
        const destroy = initializeTheme({
            root: document,
            screenshots,
            storage: { setItem: vi.fn() },
            windowObject: {
                matchMedia: vi.fn(() => mediaQuery),
            },
        });

        trigger.click();
        expect(trigger.getAttribute('aria-expanded')).toBe('true');
        expect(menu.classList.contains('hidden')).toBe(false);

        document.querySelector('[data-theme-option="system"][aria-checked]').click();
        expect(trigger.getAttribute('aria-expanded')).toBe('false');
        expect(document.activeElement).toBe(trigger);

        mediaQuery.setMatches(true);
        expect(document.documentElement.dataset.theme).toBe('dark');

        document.querySelector('[data-theme-option="light"][aria-pressed]').click();
        mediaQuery.setMatches(false);
        expect(document.documentElement.dataset.theme).toBe('light');

        destroy();
    });
});

describe('copy controls', () => {
    it('announces success and restores the control after the timeout', async () => {
        vi.useFakeTimers();
        mountCopyControl();

        const writeText = vi.fn().mockResolvedValue(undefined);
        const button = document.querySelector('[data-copy-command]');
        const status = document.querySelector('[data-copy-status]');
        const destroy = initializeCopyButtons({
            root: document,
            navigatorObject: { clipboard: { writeText } },
            windowObject: window,
        });

        button.click();
        await vi.waitFor(() => expect(button.getAttribute('aria-label')).toBe('success-label'));

        expect(writeText).toHaveBeenCalledWith('example-command');
        expect(button.querySelector('[data-copy-icon]').classList.contains('hidden')).toBe(true);
        expect(button.querySelector('[data-copy-success]').classList.contains('hidden')).toBe(false);
        expect(status.textContent).toBe('success-label');

        await vi.advanceTimersByTimeAsync(3000);

        expect(button.getAttribute('aria-label')).toBe('copy-label');
        expect(button.querySelector('[data-copy-icon]').classList.contains('hidden')).toBe(false);
        expect(button.querySelector('[data-copy-success]').classList.contains('hidden')).toBe(true);
        expect(status.textContent).toBe('');

        destroy();
    });

    it('announces a clipboard failure without showing a success state', async () => {
        mountCopyControl();

        const button = document.querySelector('[data-copy-command]');
        const status = document.querySelector('[data-copy-status]');
        const destroy = initializeCopyButtons({
            root: document,
            navigatorObject: {
                clipboard: {
                    writeText: vi.fn().mockRejectedValue(new Error('clipboard unavailable')),
                },
            },
            windowObject: window,
        });

        button.click();

        await vi.waitFor(() => expect(status.textContent).toBe('Could not copy: example-command'));
        expect(button.getAttribute('aria-label')).toBe('copy-label');
        expect(button.querySelector('[data-copy-success]').classList.contains('hidden')).toBe(true);

        destroy();
    });

    it('uses the document copy command when the clipboard API is unavailable', async () => {
        mountCopyControl();

        Object.defineProperty(document, 'execCommand', {
            configurable: true,
            value: vi.fn(() => true),
        });

        await copyText('example-command', {
            root: document,
            navigatorObject: {},
        });

        expect(document.execCommand).toHaveBeenCalledWith('copy');
        expect(document.querySelector('textarea')).toBeNull();
    });
});
