<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth" data-theme="dark" data-theme-mode="system">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta
            name="description"
            content="Install New Debug Bar in a Laravel app, check that it is working, and learn the optional configuration steps."
        >
        <meta name="color-scheme" content="dark light">
        <meta name="theme-color" content="#07070a">

        <link rel="canonical" href="{{ url('/docs/installation') }}">

        <meta property="og:type" content="article">
        <meta property="og:title" content="Install New Debug Bar in Laravel">
        <meta property="og:description" content="Add New Debug Bar to a Laravel app with one Composer command. No service provider, migrations, or asset publishing required.">
        <meta property="og:url" content="{{ url('/docs/installation') }}">

        <title>Install New Debug Bar in Laravel | New Debug Bar</title>

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
        @include('partials.site-header')

        <main class="border-b border-zinc-950/[0.07] bg-white dark:border-white/[0.08] dark:bg-[#09090c]">
            <div class="mx-auto grid max-w-[100rem] lg:grid-cols-[14rem_minmax(0,1fr)] xl:grid-cols-[14rem_minmax(0,48rem)_13rem]">
                <aside class="hidden border-r border-zinc-950/[0.07] px-8 py-14 lg:block dark:border-white/[0.08]" aria-label="Documentation navigation">
                    <nav class="sticky top-8">
                        <p class="text-sm font-semibold text-zinc-950 dark:text-white">Documentation</p>

                        <div class="mt-7">
                            <p class="text-xs font-semibold uppercase tracking-[0.16em] text-zinc-400 dark:text-zinc-500">Getting started</p>
                            <a
                                class="mt-3 flex min-h-10 items-center rounded-lg bg-violet-50 px-3 text-sm font-medium text-violet-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:bg-violet-400/10 dark:text-violet-300"
                                href="{{ route('docs.installation') }}"
                                aria-current="page"
                            >
                                Installation
                            </a>
                        </div>

                        <div class="mt-8 border-t border-zinc-950/[0.07] pt-7 dark:border-white/[0.08]">
                            <p class="text-xs font-semibold uppercase tracking-[0.16em] text-zinc-400 dark:text-zinc-500">Use with agents</p>
                            <a
                                class="mt-3 flex min-h-10 items-center gap-2 rounded-lg px-3 text-sm font-medium text-zinc-600 transition-colors hover:bg-zinc-100 hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:text-zinc-400 dark:hover:bg-white/[0.06] dark:hover:text-white"
                                href="https://github.com/newdebugbar/newdebugbar/blob/main/docs/mcp.md"
                            >
                                MCP setup
                                <svg class="size-3.5" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                                    <path d="M5 11 11 5M6 5h5v5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                    </nav>
                </aside>

                <article class="min-w-0 px-5 py-10 sm:px-8 sm:py-14 lg:px-10 xl:px-12 xl:py-16">
                    <nav class="mb-8 flex items-center gap-2 text-sm text-zinc-500 lg:hidden dark:text-zinc-400" aria-label="Breadcrumb">
                        <span>Docs</span>
                        <svg class="size-3.5" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                            <path d="m6 3.5 4 4.5-4 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="font-medium text-zinc-800 dark:text-zinc-200">Installation</span>
                    </nav>

                    <header>
                        <p class="text-sm font-semibold text-violet-700 dark:text-violet-300">Getting started</p>
                        <h1 class="mt-3 text-balance text-[2.75rem] font-semibold leading-[1.02] tracking-[-0.052em] text-zinc-950 sm:text-[3.5rem] dark:text-white">
                            Install New Debug Bar
                        </h1>
                        <p class="mt-6 max-w-[42rem] text-lg leading-8 text-zinc-600 sm:text-xl sm:leading-9 dark:text-zinc-400">
                            Add it to your Laravel app with one Composer command. Laravel discovers the package and the bar appears automatically while you work locally.
                        </p>
                    </header>

                    <aside class="mt-10 flex gap-4 rounded-2xl border border-violet-200 bg-violet-50/70 p-5 dark:border-violet-400/20 dark:bg-violet-400/[0.08]" aria-label="Development version note">
                        <svg class="mt-0.5 size-5 shrink-0 text-violet-600 dark:text-violet-300" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 3.5 21 20H3L12 3.5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                            <path d="M12 9v4.5M12 17h.01" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                        </svg>
                        <div>
                            <p class="font-semibold text-violet-950 dark:text-violet-100">Install the development version for now</p>
                            <p class="mt-1 text-sm leading-6 text-violet-900/75 dark:text-violet-200/75">New Debug Bar has not tagged version 1.0 yet, so the command below installs the current <code class="font-mono text-[0.9em]">dev-main</code> build.</p>
                        </div>
                    </aside>

                    <section id="requirements" class="scroll-mt-8 pt-14" aria-labelledby="requirements-title">
                        <h2 id="requirements-title" class="text-2xl font-semibold tracking-[-0.035em] text-zinc-950 dark:text-white">Requirements</h2>
                        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Before installing, make sure the app meets these requirements:</p>

                        <ul class="mt-5 space-y-3" role="list">
                            <li class="flex gap-3 text-base leading-7 text-zinc-700 dark:text-zinc-300">
                                <svg class="mt-1 size-5 shrink-0 text-violet-600 dark:text-violet-400" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                                    <path d="m4.5 10.5 3.2 3.2 7.8-8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                PHP 8.1 or newer.
                            </li>
                            <li class="flex gap-3 text-base leading-7 text-zinc-700 dark:text-zinc-300">
                                <svg class="mt-1 size-5 shrink-0 text-violet-600 dark:text-violet-400" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                                    <path d="m4.5 10.5 3.2 3.2 7.8-8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Laravel 10 or newer.
                            </li>
                            <li class="flex gap-3 text-base leading-7 text-zinc-700 dark:text-zinc-300">
                                <svg class="mt-1 size-5 shrink-0 text-violet-600 dark:text-violet-400" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                                    <path d="m4.5 10.5 3.2 3.2 7.8-8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                A Laravel app running in its <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">local</code> environment.
                            </li>
                        </ul>

                        <div class="mt-6 rounded-xl border border-zinc-200 bg-zinc-50 p-4 text-sm leading-6 text-zinc-600 dark:border-white/10 dark:bg-white/[0.035] dark:text-zinc-400">
                            <strong class="font-semibold text-zinc-900 dark:text-zinc-100">Livewire compatibility:</strong>
                            New Debug Bar uses Livewire 4 for its own interface. Your app does not need to use Livewire, but apps that already use Livewire 3 are not supported.
                        </div>
                    </section>

                    <section id="install" class="scroll-mt-8 pt-14" aria-labelledby="install-title">
                        <h2 id="install-title" class="text-2xl font-semibold tracking-[-0.035em] text-zinc-950 dark:text-white">Install the package</h2>
                        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Run this command from your Laravel app:</p>

                        <div class="mt-5 overflow-hidden rounded-2xl border border-zinc-800 bg-[#111116] shadow-lg shadow-zinc-950/10 dark:border-white/10 dark:shadow-black/25" data-copy-root>
                            <div class="flex min-w-0 items-center gap-4 px-4 py-4 sm:px-5">
                                <span class="shrink-0 font-mono text-sm text-violet-400" aria-hidden="true">$</span>
                                <code class="min-w-0 flex-1 overflow-x-auto whitespace-nowrap font-mono text-sm leading-6 text-zinc-100 sm:text-[0.9375rem]">composer require --dev newdebugbar/newdebugbar:dev-main</code>
                                <button
                                    class="relative grid size-6 shrink-0 place-items-center text-zinc-400 transition-colors after:absolute after:-inset-2.5 after:content-[''] hover:text-white focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-400"
                                    type="button"
                                    data-copy-command="composer require --dev newdebugbar/newdebugbar:dev-main"
                                    data-copy-label="Copy Composer command"
                                    data-copy-success="Composer command copied"
                                    aria-label="Copy Composer command"
                                    title="Copy Composer command"
                                >
                                    <svg data-copy-icon class="size-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <rect x="8" y="8" width="11" height="11" rx="2" stroke="currentColor" stroke-width="1.7"/>
                                        <path d="M16 8V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                                    </svg>
                                    <svg data-copy-success class="hidden size-5 text-emerald-400" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="m5 12.5 4.3 4.3L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                <p class="sr-only" data-copy-status aria-live="polite"></p>
                            </div>
                        </div>

                        <p class="mt-4 text-sm leading-6 text-zinc-500 dark:text-zinc-500">Keep New Debug Bar in <code class="font-mono text-[0.9em] text-zinc-700 dark:text-zinc-300">require-dev</code> so production installs skip it.</p>
                    </section>

                    <section id="verify" class="scroll-mt-8 pt-14" aria-labelledby="verify-title">
                        <h2 id="verify-title" class="text-2xl font-semibold tracking-[-0.035em] text-zinc-950 dark:text-white">Check that it works</h2>
                        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Open any normal page in your app while Laravel is using the <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">local</code> environment. The bar should appear at the bottom of the browser.</p>

                        <div class="mt-6 flex gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm leading-6 text-emerald-950 dark:border-emerald-400/20 dark:bg-emerald-400/[0.08] dark:text-emerald-100">
                            <svg class="mt-0.5 size-5 shrink-0 text-emerald-600 dark:text-emerald-400" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                                <path d="m4.5 10.5 3.2 3.2 7.8-8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <p><strong class="font-semibold">No extra setup:</strong> you do not need to register a service provider, run migrations, or publish frontend assets.</p>
                        </div>

                        <figure class="mt-7">
                            <x-screenshots.request-inspector
                                alt="New Debug Bar open over a Laravel page with request, query, and duration details"
                                loading="lazy"
                            />
                            <figcaption class="mt-3 text-sm leading-6 text-zinc-500 dark:text-zinc-500">The compact bar stays at the bottom of your app until you open the inspector.</figcaption>
                        </figure>
                    </section>

                    <section id="configuration" class="scroll-mt-8 pt-14" aria-labelledby="configuration-title">
                        <h2 id="configuration-title" class="text-2xl font-semibold tracking-[-0.035em] text-zinc-950 dark:text-white">Optional configuration</h2>
                        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The defaults work without a config file. Publish one only when you need to change a setting:</p>

                        <div class="mt-5 overflow-hidden rounded-2xl border border-zinc-800 bg-[#111116]" data-copy-root>
                            <div class="flex min-w-0 items-center gap-4 px-4 py-4 sm:px-5">
                                <span class="shrink-0 font-mono text-sm text-violet-400" aria-hidden="true">$</span>
                                <code class="min-w-0 flex-1 overflow-x-auto whitespace-nowrap font-mono text-sm leading-6 text-zinc-100 sm:text-[0.9375rem]">php artisan vendor:publish --tag=newdebugbar-config</code>
                                <button
                                    class="relative grid size-6 shrink-0 place-items-center text-zinc-400 transition-colors after:absolute after:-inset-2.5 after:content-[''] hover:text-white focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-400"
                                    type="button"
                                    data-copy-command="php artisan vendor:publish --tag=newdebugbar-config"
                                    data-copy-label="Copy publish command"
                                    data-copy-success="Publish command copied"
                                    aria-label="Copy publish command"
                                    title="Copy publish command"
                                >
                                    <svg data-copy-icon class="size-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <rect x="8" y="8" width="11" height="11" rx="2" stroke="currentColor" stroke-width="1.7"/>
                                        <path d="M16 8V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                                    </svg>
                                    <svg data-copy-success class="hidden size-5 text-emerald-400" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="m5 12.5 4.3 4.3L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                <p class="sr-only" data-copy-status aria-live="polite"></p>
                            </div>
                        </div>

                        <p class="mt-6 text-base leading-7 text-zinc-600 dark:text-zinc-400">To leave the package installed but turn it off, add this to your <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">.env</code> file:</p>

                        <div class="mt-5 overflow-hidden rounded-2xl border border-zinc-800 bg-[#111116]" data-copy-root>
                            <div class="flex min-w-0 items-center gap-4 px-4 py-4 sm:px-5">
                                <code class="min-w-0 flex-1 overflow-x-auto whitespace-nowrap font-mono text-sm leading-6 text-zinc-100 sm:text-[0.9375rem]">NEWDEBUGBAR_ENABLED=false</code>
                                <button
                                    class="relative grid size-6 shrink-0 place-items-center text-zinc-400 transition-colors after:absolute after:-inset-2.5 after:content-[''] hover:text-white focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-400"
                                    type="button"
                                    data-copy-command="NEWDEBUGBAR_ENABLED=false"
                                    data-copy-label="Copy environment setting"
                                    data-copy-success="Environment setting copied"
                                    aria-label="Copy environment setting"
                                    title="Copy environment setting"
                                >
                                    <svg data-copy-icon class="size-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <rect x="8" y="8" width="11" height="11" rx="2" stroke="currentColor" stroke-width="1.7"/>
                                        <path d="M16 8V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                                    </svg>
                                    <svg data-copy-success class="hidden size-5 text-emerald-400" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="m5 12.5 4.3 4.3L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                <p class="sr-only" data-copy-status aria-live="polite"></p>
                            </div>
                        </div>
                    </section>

                    <section id="troubleshooting" class="scroll-mt-8 pt-14" aria-labelledby="troubleshooting-title">
                        <h2 id="troubleshooting-title" class="text-2xl font-semibold tracking-[-0.035em] text-zinc-950 dark:text-white">Troubleshooting</h2>

                        <div class="mt-5 divide-y divide-zinc-200 border-y border-zinc-200 dark:divide-white/10 dark:border-white/10">
                            <details class="group py-1">
                                <summary class="flex min-h-14 cursor-pointer list-none items-center gap-4 rounded-lg py-3 font-medium text-zinc-900 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:text-zinc-100 [&::-webkit-details-marker]:hidden">
                                    The bar does not appear
                                    <svg class="ml-auto size-4 shrink-0 text-zinc-400 transition-transform group-open:rotate-45" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                                        <path d="M8 3v10M3 8h10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                    </svg>
                                </summary>
                                <div class="pb-5 pr-8 text-sm leading-6 text-zinc-600 dark:text-zinc-400">
                                    Confirm that Laravel reports the <code class="font-mono text-[0.9em] text-zinc-900 dark:text-zinc-200">local</code> environment and that <code class="font-mono text-[0.9em] text-zinc-900 dark:text-zinc-200">NEWDEBUGBAR_ENABLED</code> is not set to <code class="font-mono text-[0.9em] text-zinc-900 dark:text-zinc-200">false</code>. If the app caches configuration, run <code class="font-mono text-[0.9em] text-zinc-900 dark:text-zinc-200">php artisan config:clear</code> and refresh the page.
                                </div>
                            </details>
                            <details class="group py-1">
                                <summary class="flex min-h-14 cursor-pointer list-none items-center gap-4 rounded-lg py-3 font-medium text-zinc-900 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:text-zinc-100 [&::-webkit-details-marker]:hidden">
                                    Composer reports a Livewire conflict
                                    <svg class="ml-auto size-4 shrink-0 text-zinc-400 transition-transform group-open:rotate-45" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                                        <path d="M8 3v10M3 8h10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                    </svg>
                                </summary>
                                <div class="pb-5 pr-8 text-sm leading-6 text-zinc-600 dark:text-zinc-400">
                                    New Debug Bar requires Livewire 4. Apps that already depend on Livewire 3 are not supported yet, even though an app does not otherwise need to use Livewire itself.
                                </div>
                            </details>
                        </div>
                    </section>

                    <section class="pt-14" aria-labelledby="next-title">
                        <a
                            class="group block rounded-2xl border border-violet-200 bg-gradient-to-br from-violet-50 to-white p-6 transition-colors hover:border-violet-300 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-500 sm:p-7 dark:border-violet-400/20 dark:from-violet-400/[0.1] dark:to-white/[0.025] dark:hover:border-violet-400/35"
                            href="https://github.com/newdebugbar/newdebugbar/blob/main/docs/mcp.md"
                        >
                            <div class="flex items-start gap-5">
                                <div class="grid size-11 shrink-0 place-items-center rounded-xl bg-violet-600 text-white shadow-lg shadow-violet-600/20 dark:bg-violet-500">
                                    <svg class="size-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M8.5 7.5 4 12l4.5 4.5M15.5 7.5 20 12l-4.5 4.5M13.5 4 10.5 20" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-semibold text-violet-700 dark:text-violet-300">Next step</p>
                                    <h2 id="next-title" class="mt-1 text-xl font-semibold tracking-[-0.025em] text-zinc-950 dark:text-white">Give your coding agent exact debug data</h2>
                                    <p class="mt-2 text-sm leading-6 text-zinc-600 dark:text-zinc-400">Connect the local MCP server so your agent can inspect saved request profiles instead of guessing from logs.</p>
                                    <span class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-violet-700 dark:text-violet-300">
                                        Open the MCP setup guide
                                        <svg class="size-4 transition-transform group-hover:translate-x-0.5" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                                            <path d="M3 8h9M8.5 4.5 12 8l-3.5 3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </section>
                </article>

                <aside class="hidden border-l border-zinc-950/[0.07] px-6 py-16 xl:block dark:border-white/[0.08]" aria-label="On this page">
                    <nav class="sticky top-8">
                        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-zinc-400 dark:text-zinc-500">On this page</p>
                        <ul class="mt-4 space-y-1 text-sm" role="list">
                            <li><a class="flex min-h-9 items-center rounded-lg px-2 text-zinc-600 transition-colors hover:bg-zinc-100 hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:text-zinc-400 dark:hover:bg-white/[0.06] dark:hover:text-white" href="#requirements">Requirements</a></li>
                            <li><a class="flex min-h-9 items-center rounded-lg px-2 text-zinc-600 transition-colors hover:bg-zinc-100 hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:text-zinc-400 dark:hover:bg-white/[0.06] dark:hover:text-white" href="#install">Install</a></li>
                            <li><a class="flex min-h-9 items-center rounded-lg px-2 text-zinc-600 transition-colors hover:bg-zinc-100 hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:text-zinc-400 dark:hover:bg-white/[0.06] dark:hover:text-white" href="#verify">Check it works</a></li>
                            <li><a class="flex min-h-9 items-center rounded-lg px-2 text-zinc-600 transition-colors hover:bg-zinc-100 hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:text-zinc-400 dark:hover:bg-white/[0.06] dark:hover:text-white" href="#configuration">Configuration</a></li>
                            <li><a class="flex min-h-9 items-center rounded-lg px-2 text-zinc-600 transition-colors hover:bg-zinc-100 hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:text-zinc-400 dark:hover:bg-white/[0.06] dark:hover:text-white" href="#troubleshooting">Troubleshooting</a></li>
                        </ul>
                    </nav>
                </aside>
            </div>
        </main>

        @include('partials.site-footer')
    </body>
</html>
