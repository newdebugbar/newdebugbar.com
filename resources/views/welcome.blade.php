<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark" data-theme-mode="system">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta
            name="description"
            content="Find Laravel bugs and bottlenecks without digging through scattered logs. Inspect requests, queries, exceptions, jobs, mail, cache, and more, with exact MCP context for coding agents."
        >
        <meta name="color-scheme" content="dark light">
        <meta name="theme-color" content="#07070a">

        <title>New Debug Bar — Laravel debugging for developers and agents</title>

        <script>
            const storedTheme = localStorage.getItem('newdebugbar-website-theme');
            const themeMode = ['system', 'light', 'dark'].includes(storedTheme) ? storedTheme : 'system';
            const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';

            document.documentElement.dataset.themeMode = themeMode;
            document.documentElement.dataset.theme = themeMode === 'system' ? systemTheme : themeMode;
        </script>

        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-zinc-50 text-zinc-950 antialiased transition-colors duration-300 dark:bg-[#07070a] dark:text-white">
        <header class="relative z-50 border-b border-zinc-200/80 bg-white/80 text-zinc-950 backdrop-blur-xl dark:border-white/10 dark:bg-[#07070a]/80 dark:text-white">
            <nav
                class="mx-auto flex h-[4.75rem] max-w-[100rem] items-center gap-2 px-4 sm:gap-5 sm:px-8 lg:px-10"
                aria-label="Primary navigation"
            >
                <a class="flex shrink-0 flex-col leading-none" href="/" aria-label="New Debug Bar for Laravel">
                    <span class="text-[0.8125rem] font-semibold tracking-[-0.02em] min-[23rem]:text-base sm:text-2xl sm:tracking-[-0.035em]">New Debug Bar</span>
                    <span class="mt-0.5 text-[0.45rem] font-semibold uppercase tracking-[0.14em] text-violet-600 min-[23rem]:text-[0.5rem] sm:mt-1 sm:text-[0.625rem] sm:tracking-[0.18em] dark:text-violet-400">for Laravel</span>
                </a>

                <div class="ml-auto flex shrink-0 items-center">
                    <div class="flex items-center gap-0.5 sm:hidden">
                        <a
                            class="flex h-10 items-center rounded-lg px-2 text-xs font-medium text-zinc-600 transition hover:bg-zinc-100 hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:text-zinc-300 dark:hover:bg-white/[0.07] dark:hover:text-white"
                            href="https://github.com/sponsors/benjamincrozat"
                        >
                            Sponsor
                        </a>
                        <a
                            class="grid size-10 place-items-center rounded-full text-zinc-500 transition hover:bg-zinc-100 hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:text-zinc-400 dark:hover:bg-white/[0.07] dark:hover:text-white"
                            href="https://github.com/newdebugbar/newdebugbar#readme"
                            aria-label="Documentation"
                            title="Documentation"
                        >
                            <svg class="size-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M6.5 3.5h7L18 8v12.5H6.5a1 1 0 0 1-1-1v-15a1 1 0 0 1 1-1Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                                <path d="M13.5 3.5V8H18M9 12h6M9 15.5h6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <a
                            class="grid size-10 place-items-center rounded-full text-zinc-500 transition hover:bg-zinc-100 hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:text-zinc-400 dark:hover:bg-white/[0.07] dark:hover:text-white"
                            href="https://github.com/newdebugbar/newdebugbar"
                            aria-label="GitHub"
                            title="GitHub"
                        >
                            <svg class="size-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M12 2.5a9.75 9.75 0 0 0-3.08 19c.49.09.67-.21.67-.47v-1.86c-2.73.59-3.31-1.16-3.31-1.16-.45-1.14-1.09-1.44-1.09-1.44-.89-.61.07-.6.07-.6.98.07 1.5 1.01 1.5 1.01.88 1.5 2.3 1.07 2.86.82.09-.64.34-1.07.62-1.32-2.18-.25-4.47-1.09-4.47-4.82 0-1.07.38-1.94 1.01-2.62-.1-.25-.44-1.24.1-2.58 0 0 .82-.26 2.68 1a9.3 9.3 0 0 1 4.88 0c1.86-1.26 2.68-1 2.68-1 .54 1.34.2 2.33.1 2.58.63.68 1.01 1.55 1.01 2.62 0 3.74-2.3 4.57-4.48 4.82.35.3.66.89.66 1.8v2.67c0 .26.18.57.67.47A9.75 9.75 0 0 0 12 2.5Z"/>
                            </svg>
                        </a>
                        <div class="relative" data-theme-menu-root>
                            <button
                                class="grid size-10 place-items-center rounded-full text-zinc-500 transition hover:bg-zinc-100 hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 aria-expanded:bg-zinc-100 aria-expanded:text-zinc-950 dark:text-zinc-400 dark:hover:bg-white/[0.07] dark:hover:text-white dark:aria-expanded:bg-white/10 dark:aria-expanded:text-white"
                                type="button"
                                data-theme-menu-trigger
                                aria-label="Choose color theme"
                                aria-controls="newdebugbar-theme-menu"
                                aria-expanded="false"
                                title="Choose color theme"
                            >
                                <svg class="size-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <circle cx="12" cy="12" r="8.5" stroke="currentColor" stroke-width="1.7"/>
                                    <path d="M12 3.5a8.5 8.5 0 0 1 0 17v-17Z" fill="currentColor"/>
                                </svg>
                            </button>
                            <div
                                id="newdebugbar-theme-menu"
                                class="absolute top-[calc(100%+1.125rem)] right-0 z-50 hidden w-44 rounded-2xl border border-zinc-200 bg-white p-1.5 text-zinc-600 shadow-xl shadow-zinc-950/10 dark:border-white/10 dark:bg-[#111116] dark:text-zinc-300 dark:shadow-black/40"
                                data-theme-menu
                                role="radiogroup"
                                aria-label="Color theme"
                            >
                                <button
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-left text-sm font-medium transition hover:bg-zinc-100 hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-violet-500 aria-checked:bg-violet-50 aria-checked:text-violet-700 dark:hover:bg-white/[0.07] dark:hover:text-white dark:aria-checked:bg-violet-400/10 dark:aria-checked:text-violet-300"
                                    type="button"
                                    data-theme-option="system"
                                    role="radio"
                                    aria-checked="true"
                                >
                                    <svg class="size-[1.05rem] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <rect x="3.5" y="4.5" width="17" height="12" rx="2" stroke="currentColor" stroke-width="1.7"/>
                                        <path d="M9 20h6M12 16.5V20" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                                    </svg>
                                    <span>System</span>
                                    <svg class="ml-auto size-4 shrink-0" data-theme-selection viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="m5 12.5 4.3 4.3L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                <button
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-left text-sm font-medium transition hover:bg-zinc-100 hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-violet-500 aria-checked:bg-violet-50 aria-checked:text-violet-700 dark:hover:bg-white/[0.07] dark:hover:text-white dark:aria-checked:bg-violet-400/10 dark:aria-checked:text-violet-300"
                                    type="button"
                                    data-theme-option="light"
                                    role="radio"
                                    aria-checked="false"
                                >
                                    <svg class="size-[1.05rem] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <circle cx="12" cy="12" r="3.5" stroke="currentColor" stroke-width="1.7"/>
                                        <path d="M12 2.5v2M12 19.5v2M21.5 12h-2M4.5 12h-2M18.72 5.28l-1.42 1.42M6.7 17.3l-1.42 1.42M18.72 18.72l-1.42-1.42M6.7 6.7 5.28 5.28" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                                    </svg>
                                    <span>Light</span>
                                    <svg class="ml-auto hidden size-4 shrink-0" data-theme-selection viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="m5 12.5 4.3 4.3L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                <button
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-left text-sm font-medium transition hover:bg-zinc-100 hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-violet-500 aria-checked:bg-violet-50 aria-checked:text-violet-700 dark:hover:bg-white/[0.07] dark:hover:text-white dark:aria-checked:bg-violet-400/10 dark:aria-checked:text-violet-300"
                                    type="button"
                                    data-theme-option="dark"
                                    role="radio"
                                    aria-checked="false"
                                >
                                    <svg class="size-[1.05rem] shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M20.2 15.1A8.5 8.5 0 0 1 8.9 3.8 8.5 8.5 0 1 0 20.2 15.1Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>Dark</span>
                                    <svg class="ml-auto hidden size-4 shrink-0" data-theme-selection viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="m5 12.5 4.3 4.3L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="hidden items-center gap-3 sm:flex">
                        <a
                            class="rounded-lg px-3 py-2 text-base text-zinc-600 transition hover:bg-zinc-100 hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:text-zinc-300 dark:hover:bg-white/5 dark:hover:text-white"
                            href="https://github.com/sponsors/benjamincrozat"
                        >
                            Sponsor
                        </a>
                        <a
                            class="rounded-lg px-3 py-2 text-base text-zinc-600 transition hover:bg-zinc-100 hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:text-zinc-300 dark:hover:bg-white/5 dark:hover:text-white"
                            href="https://github.com/newdebugbar/newdebugbar#readme"
                        >
                            Docs
                        </a>
                        <a
                            class="rounded-lg px-3 py-2 text-base text-zinc-600 transition hover:bg-zinc-100 hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:text-zinc-300 dark:hover:bg-white/5 dark:hover:text-white"
                            href="https://github.com/newdebugbar/newdebugbar"
                        >
                            GitHub
                        </a>
                        <div
                            class="ml-0.5 inline-flex items-center gap-0.5 rounded-full border border-zinc-200 bg-white p-1 text-zinc-500 shadow-sm dark:border-white/10 dark:bg-white/[0.04] dark:text-zinc-400 dark:shadow-none"
                            role="group"
                            aria-label="Color theme"
                        >
                            <button
                                class="grid size-8 place-items-center rounded-full transition hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 aria-pressed:bg-zinc-100 aria-pressed:text-zinc-950 dark:hover:text-white dark:aria-pressed:bg-white/10 dark:aria-pressed:text-white"
                                type="button"
                                data-theme-option="system"
                                aria-label="Use system theme"
                                aria-pressed="true"
                                title="Use system theme"
                            >
                                <svg class="size-[1.05rem]" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <rect x="3.5" y="4.5" width="17" height="12" rx="2" stroke="currentColor" stroke-width="1.7"/>
                                    <path d="M9 20h6M12 16.5V20" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                                </svg>
                            </button>
                            <button
                                class="grid size-8 place-items-center rounded-full transition hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 aria-pressed:bg-zinc-100 aria-pressed:text-zinc-950 dark:hover:text-white dark:aria-pressed:bg-white/10 dark:aria-pressed:text-white"
                                type="button"
                                data-theme-option="light"
                                aria-label="Use light theme"
                                aria-pressed="false"
                                title="Use light theme"
                            >
                                <svg class="size-[1.05rem]" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <circle cx="12" cy="12" r="3.5" stroke="currentColor" stroke-width="1.7"/>
                                    <path d="M12 2.5v2M12 19.5v2M21.5 12h-2M4.5 12h-2M18.72 5.28l-1.42 1.42M6.7 17.3l-1.42 1.42M18.72 18.72l-1.42-1.42M6.7 6.7 5.28 5.28" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                                </svg>
                            </button>
                            <button
                                class="grid size-8 place-items-center rounded-full transition hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 aria-pressed:bg-zinc-100 aria-pressed:text-zinc-950 dark:hover:text-white dark:aria-pressed:bg-white/10 dark:aria-pressed:text-white"
                                type="button"
                                data-theme-option="dark"
                                aria-label="Use dark theme"
                                aria-pressed="false"
                                title="Use dark theme"
                            >
                                <svg class="size-[1.05rem]" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M20.2 15.1A8.5 8.5 0 0 1 8.9 3.8 8.5 8.5 0 1 0 20.2 15.1Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <main class="hero-backdrop overflow-hidden">
            <section class="mx-auto grid max-w-[100rem] items-center gap-10 px-5 py-8 sm:px-8 lg:px-10 min-[80rem]:grid-cols-[minmax(28rem,0.78fr)_minmax(44rem,1.22fr)] min-[90rem]:gap-12 min-[100rem]:gap-16" aria-labelledby="hero-title">
                <div class="relative z-10 w-full min-w-0 max-w-[36rem]">
                    <h1 id="hero-title" class="text-balance text-[2.55rem] font-semibold leading-none tracking-[-0.055em] text-zinc-950 sm:text-[3.5rem] min-[76rem]:text-[3.65rem] min-[90rem]:text-[4rem] dark:text-white">
                        Powerful, agent-friendly Laravel debugging—free and open source
                    </h1>

                    <p class="mt-7 max-w-[32rem] text-lg leading-8 text-zinc-600 sm:text-xl sm:leading-9 dark:text-zinc-400">
                        Find bugs and bottlenecks without digging through scattered logs. Inspect requests, queries, exceptions, jobs, mail, cache, and more in one place—while MCP gives your coding agent exact context with less guessing and fewer tokens.
                    </p>

                    <div class="mt-9 flex max-w-full flex-wrap items-center gap-x-[0.5ch] gap-y-1">
                        <code class="basis-full whitespace-nowrap font-mono text-xs leading-5 font-normal tracking-[-0.015em] text-zinc-950 min-[23rem]:text-[0.8125rem] sm:text-sm sm:leading-6 min-[80rem]:text-[0.9375rem] min-[80rem]:tracking-[-0.03em] min-[90rem]:basis-auto dark:text-white">composer require</code>
                        <code class="whitespace-nowrap font-mono text-xs leading-5 font-normal tracking-[-0.015em] text-zinc-950 min-[23rem]:text-[0.8125rem] sm:text-sm sm:leading-6 min-[80rem]:text-[0.9375rem] min-[80rem]:tracking-[-0.03em] dark:text-white">newdebugbar/newdebugbar:dev-main</code>
                        <span class="inline-flex shrink-0 items-center gap-2.5 whitespace-nowrap sm:gap-3">
                            <code class="font-mono text-xs leading-5 font-normal tracking-[-0.015em] text-zinc-950 min-[23rem]:text-[0.8125rem] sm:text-sm sm:leading-6 min-[80rem]:text-[0.9375rem] min-[80rem]:tracking-[-0.03em] dark:text-white">--dev</code>
                            <button
                                class="inline-grid size-[1.125rem] shrink-0 place-items-center align-middle text-zinc-500 transition-colors hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-500 dark:text-zinc-400 dark:hover:text-white"
                                type="button"
                                data-copy-command="composer require newdebugbar/newdebugbar:dev-main --dev"
                                aria-label="Copy install command"
                                title="Copy install command"
                            >
                                <svg data-copy-icon class="size-[1.125rem]" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <rect x="8" y="8" width="11" height="11" rx="2" stroke="currentColor" stroke-width="1.7"/>
                                    <path d="M16 8V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                                </svg>
                                <svg data-copy-success class="hidden size-[1.125rem] text-emerald-500" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="m5 12.5 4.3 4.3L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </span>
                        <p class="sr-only" data-copy-status aria-live="polite"></p>
                    </div>
                </div>

                <div class="hero-product">
                    <picture class="hero-product__picture" data-hero-product>
                        <source media="(max-width: 47.999rem)" data-hero-mobile-source>
                        <img
                            class="hero-product__image"
                            data-hero-image
                            width="1536"
                            height="780"
                            alt="New Debug Bar request inspector showing the request trace, route, controller, response, query count, and duration for a Kyoto trip page"
                            decoding="async"
                            fetchpriority="high"
                        >
                    </picture>
                </div>
            </section>

            <section class="relative border-t border-zinc-200/70 dark:border-white/[0.08]" aria-labelledby="sponsors-title">
                <div class="mx-auto flex max-w-[100rem] flex-col items-center px-5 py-10 sm:px-8 lg:px-10">
                    <h2 id="sponsors-title" class="text-[0.6875rem] font-semibold uppercase tracking-[0.2em] text-zinc-500 dark:text-zinc-500">
                        Supported by
                    </h2>

                    <ul class="mt-6 flex w-full max-w-[36rem] flex-col items-center justify-center gap-4 min-[23rem]:flex-row min-[23rem]:gap-6 sm:gap-8" role="list">
                        <li>
                            <a
                                class="inline-flex min-h-12 items-center gap-2.5 rounded-xl px-3 py-2 text-zinc-950 transition-colors hover:text-violet-700 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-500 dark:text-white dark:hover:text-violet-300"
                                href="https://onlyfansapi.com"
                                target="_blank"
                                rel="noopener noreferrer sponsored"
                                aria-label="Visit OnlyFans API, a New Debug Bar sponsor"
                            >
                                <svg class="size-5 sm:size-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="m4 17 6-6-6-6M12 19h8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="text-base font-semibold tracking-[-0.025em] sm:text-lg">OnlyFans API</span>
                            </a>
                        </li>
                        <li class="hidden h-8 w-px bg-zinc-200 min-[23rem]:block dark:bg-white/10" aria-hidden="true"></li>
                        <li>
                            <a
                                class="inline-flex min-h-12 min-w-36 items-center justify-center rounded-xl bg-zinc-950/[0.04] px-5 text-sm font-medium text-zinc-600 transition-[background-color,color] hover:bg-zinc-950/[0.07] hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-500 dark:bg-white/[0.06] dark:text-zinc-400 dark:hover:bg-white/[0.1] dark:hover:text-white"
                                href="https://github.com/sponsors/benjamincrozat"
                                aria-label="Sponsor New Debug Bar and add your logo"
                            >
                                Your logo here
                            </a>
                        </li>
                    </ul>
                </div>
            </section>
        </main>
    </body>
</html>
