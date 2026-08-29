@php($docsActive = request()->routeIs('docs.*'))

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
                    class="mr-2 flex h-10 items-center rounded-lg text-sm font-medium text-violet-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:text-violet-300"
                    href="https://github.com/sponsors/benjamincrozat"
                >
                    Sponsor
                </a>
                <a
                    @class([
                        'grid size-10 place-items-center rounded-full transition focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500',
                        'bg-violet-50 text-violet-700 dark:bg-violet-400/10 dark:text-violet-300' => $docsActive,
                        'text-zinc-500 hover:bg-zinc-100 hover:text-zinc-950 dark:text-zinc-400 dark:hover:bg-white/[0.07] dark:hover:text-white' => ! $docsActive,
                    ])
                    href="{{ route('docs.installation') }}"
                    aria-label="Documentation"
                    @if ($docsActive) aria-current="page" @endif
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
                    class="mr-2 inline-flex min-h-10 items-center rounded-lg text-base font-medium text-violet-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:text-violet-300"
                    href="https://github.com/sponsors/benjamincrozat"
                >
                    Sponsor
                </a>
                <a
                    @class([
                        'rounded-lg px-3 py-2 text-base transition focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500',
                        'bg-violet-50 font-medium text-violet-700 dark:bg-violet-400/10 dark:text-violet-300' => $docsActive,
                        'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-950 dark:text-zinc-300 dark:hover:bg-white/5 dark:hover:text-white' => ! $docsActive,
                    ])
                    href="{{ route('docs.installation') }}"
                    @if ($docsActive) aria-current="page" @endif
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
