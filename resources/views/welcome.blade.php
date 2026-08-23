<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta
            name="description"
            content="Inspect every Laravel request in a modern UI and give coding agents focused, structured debug data through MCP."
        >
        <meta name="color-scheme" content="dark light">
        <meta name="theme-color" content="#07070a">

        <title>New Debug Bar — Laravel debugging for developers and agents</title>

        <script>
            document.documentElement.dataset.theme = localStorage.getItem('newdebugbar-website-theme') === 'light'
                ? 'light'
                : 'dark';
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
                <a class="text-[1.35rem] font-semibold tracking-[-0.035em] sm:text-2xl" href="/">
                    New Debug Bar
                </a>

                <div class="ml-auto flex items-center gap-1 sm:gap-3">
                    <a
                        class="rounded-lg px-2.5 py-2 text-sm text-zinc-600 transition hover:bg-zinc-100 hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 sm:px-3 sm:text-base dark:text-zinc-300 dark:hover:bg-white/5 dark:hover:text-white"
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
                    <button
                        class="ml-0.5 grid size-10 place-items-center rounded-full border border-zinc-200 bg-white text-zinc-700 transition hover:border-zinc-300 hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:border-white/10 dark:bg-white/[0.04] dark:text-zinc-300 dark:hover:border-white/20 dark:hover:text-white"
                        type="button"
                        data-theme-toggle
                        aria-label="Switch to light theme"
                        title="Switch to light theme"
                    >
                        <svg data-theme-icon="light" class="hidden size-[1.1rem] dark:block" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <circle cx="12" cy="12" r="3.5" stroke="currentColor" stroke-width="1.7"/>
                            <path d="M12 2.5v2M12 19.5v2M21.5 12h-2M4.5 12h-2M18.72 5.28l-1.42 1.42M6.7 17.3l-1.42 1.42M18.72 18.72l-1.42-1.42M6.7 6.7 5.28 5.28" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                        </svg>
                        <svg data-theme-icon="dark" class="size-[1.1rem] dark:hidden" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M20.2 15.1A8.5 8.5 0 0 1 8.9 3.8 8.5 8.5 0 1 0 20.2 15.1Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </nav>
        </header>

        <main class="hero-backdrop overflow-hidden">
            <section class="mx-auto grid min-h-[calc(100svh-4.75rem)] max-w-[100rem] items-center gap-14 px-5 py-16 sm:px-8 sm:py-20 lg:px-10 min-[70rem]:grid-cols-[minmax(25rem,0.82fr)_minmax(48rem,1.45fr)] min-[70rem]:gap-12 min-[70rem]:py-24" aria-labelledby="hero-title">
                <div class="relative z-10 w-full min-w-0 max-w-[34rem]">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-violet-600 sm:text-[0.82rem] dark:text-violet-400">
                        Built for developers + agents
                    </p>

                    <h1 id="hero-title" class="mt-6 text-[clamp(2.75rem,6vw,4.4rem)] font-semibold leading-[0.98] tracking-[-0.055em] text-zinc-950 dark:text-white">
                        Stop making your coding agent guess.
                    </h1>

                    <p class="mt-7 max-w-[32rem] text-lg leading-8 text-zinc-600 sm:text-xl sm:leading-9 dark:text-zinc-400">
                        Inspect every Laravel request in a modern UI—and expose focused, structured debug data through MCP.
                    </p>

                    <div class="mt-9 max-w-[31rem]">
                        <div class="flex min-h-[4.5rem] items-center gap-2 rounded-xl border border-zinc-200 bg-white/75 px-3 shadow-sm sm:gap-3 sm:px-5 dark:border-white/[0.13] dark:bg-white/[0.025] dark:shadow-none">
                            <code class="min-w-0 flex-1 overflow-x-auto whitespace-nowrap font-mono text-[0.625rem] font-medium text-zinc-900 sm:text-[0.8rem] dark:text-zinc-100">composer require newdebugbar/newdebugbar --dev</code>
                            <button
                                class="grid size-8 shrink-0 place-items-center rounded-lg text-zinc-500 transition hover:bg-zinc-100 hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 sm:size-9 dark:text-zinc-400 dark:hover:bg-white/[0.07] dark:hover:text-white"
                                type="button"
                                data-copy-command="composer require newdebugbar/newdebugbar --dev"
                                aria-label="Copy install command"
                                title="Copy install command"
                            >
                                <svg data-copy-icon class="size-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <rect x="8" y="8" width="11" height="11" rx="2" stroke="currentColor" stroke-width="1.7"/>
                                    <path d="M16 8V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                                </svg>
                                <svg data-copy-success class="hidden size-5 text-emerald-500" viewBox="0 0 24 24" fill="none" aria-hidden="true">
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
