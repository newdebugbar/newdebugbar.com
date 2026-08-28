<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark" data-theme-mode="system">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta
            name="description"
            content="Inspect Laravel requests, queries, exceptions, logs, events, jobs, mail, cache, and more, with structured profiles for coding agents through MCP."
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
        <header class="border-b border-zinc-200/80 bg-white/80 text-zinc-950 backdrop-blur-xl dark:border-white/10 dark:bg-[#07070a]/80 dark:text-white">
            <nav
                class="mx-auto flex h-[4.75rem] max-w-[100rem] items-center gap-5 px-5 sm:px-8 lg:px-10"
                aria-label="Primary navigation"
            >
                <a class="flex shrink-0 flex-col leading-none" href="/" aria-label="New Debug Bar for Laravel">
                    <span class="text-[1.35rem] font-semibold tracking-[-0.035em] sm:text-2xl">New Debug Bar</span>
                    <span class="mt-1 text-[0.625rem] font-semibold uppercase tracking-[0.18em] text-violet-600 dark:text-violet-400">for Laravel</span>
                </a>

                <div class="ml-auto flex items-center gap-1 sm:gap-3">
                    <a
                        class="hidden rounded-lg px-2.5 py-2 text-sm text-zinc-600 transition hover:bg-zinc-100 hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 min-[22rem]:block sm:px-3 sm:text-base dark:text-zinc-300 dark:hover:bg-white/5 dark:hover:text-white"
                        href="https://github.com/newdebugbar/newdebugbar#readme"
                    >
                        Docs
                    </a>
                    <a
                        class="hidden rounded-lg px-3 py-2 text-base text-zinc-600 transition hover:bg-zinc-100 hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 min-[25rem]:block dark:text-zinc-300 dark:hover:bg-white/5 dark:hover:text-white"
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
            </nav>
        </header>

        <main class="hero-backdrop overflow-hidden">
            <section class="mx-auto grid min-h-[calc(100svh-4.75rem)] max-w-[100rem] items-center gap-14 px-5 py-16 sm:px-8 sm:py-20 lg:px-10 min-[76rem]:grid-cols-[minmax(28rem,0.78fr)_minmax(44rem,1.22fr)] min-[76rem]:gap-8 min-[76rem]:py-24" aria-labelledby="hero-title">
                <div class="relative z-10 w-full min-w-0 max-w-[36rem]">
                    <h1 id="hero-title" class="text-balance text-[2.55rem] font-semibold leading-none tracking-[-0.055em] text-zinc-950 sm:text-[3.5rem] min-[76rem]:text-[3.65rem] min-[90rem]:text-[4rem] dark:text-white">
                        Powerful, agent-friendly Laravel debugging—free and open source
                    </h1>

                    <p class="mt-7 max-w-[32rem] text-lg leading-8 text-zinc-600 sm:text-xl sm:leading-9 dark:text-zinc-400">
                        Inspect requests, queries, exceptions, logs, events, jobs, mail, cache, and more in one focused interface. Coding agents can read the same structured profiles through MCP with fewer tokens.
                    </p>

                    <div class="mt-9 max-w-[31rem]">
                        <div class="inline-flex max-w-full items-center gap-1.5 rounded-xl border border-zinc-200 bg-white/75 py-2 pr-2 pl-4 shadow-sm dark:border-white/[0.13] dark:bg-white/[0.025] dark:shadow-none">
                            <code class="min-w-0 flex-1 overflow-x-auto whitespace-nowrap font-mono text-[0.5625rem] leading-4 font-medium text-zinc-900 sm:text-xs dark:text-zinc-100">composer require newdebugbar/newdebugbar:dev-main --dev</code>
                            <button
                                class="grid size-7 shrink-0 place-items-center rounded-lg text-zinc-500 transition hover:bg-zinc-100 hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:text-zinc-400 dark:hover:bg-white/[0.07] dark:hover:text-white"
                                type="button"
                                data-copy-command="composer require newdebugbar/newdebugbar:dev-main --dev"
                                aria-label="Copy install command"
                                title="Copy install command"
                            >
                                <svg data-copy-icon class="size-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <rect x="8" y="8" width="11" height="11" rx="2" stroke="currentColor" stroke-width="1.7"/>
                                    <path d="M16 8V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                                </svg>
                                <svg data-copy-success class="hidden size-4 text-emerald-500" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="m5 12.5 4.3 4.3L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
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
                            alt="New Debug Bar request inspector showing the timeline, route, controller, response, query count, and duration for a Kyoto trip page"
                            decoding="async"
                            fetchpriority="high"
                        >
                    </picture>
                </div>
            </section>
        </main>
    </body>
</html>
