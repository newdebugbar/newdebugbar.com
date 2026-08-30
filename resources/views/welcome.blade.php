@php($installation = config('newdebugbar.installation'))

<x-layouts.site
    title="New Debug Bar — Laravel debugging for developers and agents"
    description="Find Laravel bugs and bottlenecks without digging through scattered logs. Inspect requests, queries, exceptions, jobs, mail, cache, and more, with exact MCP context for coding agents."
    :canonical="url('/')"
>
    <main class="relative isolate [background:radial-gradient(circle_at_73%_46%,rgb(124_58_237_/_10%),transparent_29rem),linear-gradient(145deg,#ffffff_0%,#fafafa_56%,#f7f5ff_100%)] max-[47.999rem]:[background:radial-gradient(circle_at_50%_74%,rgb(124_58_237_/_10%),transparent_24rem),#fafafa] dark:[background:radial-gradient(circle_at_73%_47%,rgb(119_87_255_/_14%),transparent_31rem),radial-gradient(circle_at_18%_87%,rgb(76_29_149_/_7%),transparent_28rem),#07070a] dark:max-[47.999rem]:[background:radial-gradient(circle_at_50%_72%,rgb(119_87_255_/_13%),transparent_24rem),#07070a]">
            <section class="relative mx-auto flex max-w-[100rem] flex-col items-center overflow-hidden px-5 pt-6 after:pointer-events-none after:absolute after:inset-x-0 after:bottom-0 after:z-20 after:h-px after:bg-[linear-gradient(to_right,transparent,rgb(24_24_27_/_12%)_18%,rgb(24_24_27_/_12%)_82%,transparent)] after:content-[''] sm:px-8 sm:pt-10 lg:px-10 dark:after:bg-[linear-gradient(to_right,transparent,rgb(255_255_255_/_14%)_18%,rgb(255_255_255_/_14%)_82%,transparent)]" aria-labelledby="hero-title">
                <div class="relative z-10 flex w-full min-w-0 flex-col items-center text-center">
                    <h1 id="hero-title" class="max-w-[62rem] text-balance text-[2.55rem] font-semibold leading-none tracking-[-0.055em] text-zinc-950 sm:text-[3.5rem] lg:text-[3.75rem] dark:text-white">
                        Powerful, agent-friendly Laravel debugging—free and open source
                    </h1>

                    <p class="mt-5 max-w-[56rem] text-lg leading-8 text-zinc-600 sm:mt-6 sm:text-xl sm:leading-9 dark:text-zinc-400">
                        Find bugs and bottlenecks without digging through scattered logs. Inspect anything in one place—while MCP gives your agent exact context with less guessing and fewer tokens.
                    </p>

                    <div class="mt-6 inline-flex max-w-full items-center gap-[1.375rem] rounded-full border border-zinc-950/[0.08] bg-white/65 px-[1.3125rem] py-3 shadow-[0_0.75rem_2.5rem_rgb(24_24_27/0.08)] backdrop-blur-xl sm:mt-7 sm:py-4 dark:border-white/10 dark:bg-white/[0.06] dark:shadow-[0_0.75rem_2.5rem_rgb(0_0_0/0.28)]" data-copy-root>
                        <span class="flex min-w-0 items-center gap-3">
                            <span class="shrink-0 font-mono text-base leading-5 text-violet-600 sm:text-lg sm:leading-6 dark:text-violet-400" aria-hidden="true">$</span>
                            <code class="min-w-0 truncate text-left font-mono text-sm leading-5 font-normal tracking-[-0.015em] text-zinc-950 sm:text-base sm:leading-6 lg:tracking-[-0.03em] dark:text-white">{{ $installation['command'] }}</code>
                        </span>
                        <button
                            class="relative inline-grid size-5 shrink-0 place-items-center text-zinc-500 transition-colors after:absolute after:-inset-2.5 after:content-[''] hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-500 dark:text-zinc-400 dark:hover:text-white"
                            type="button"
                            data-copy-command="{{ $installation['command'] }}"
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
                        <p class="sr-only" data-copy-status aria-live="polite"></p>
                    </div>

                    <div class="mt-6 flex flex-wrap items-center justify-center gap-x-4 gap-y-2 sm:mt-8" aria-labelledby="sponsors-title">
                        <h2 id="sponsors-title" class="text-[0.6875rem] font-semibold uppercase tracking-[0.2em] text-zinc-500 dark:text-zinc-500">
                            Supported by
                        </h2>

                        <ul class="flex flex-wrap items-center justify-center gap-2 sm:gap-3" role="list">
                            <li>
                                <a
                                    class="inline-flex min-h-10 items-center gap-2 rounded-full px-3 text-zinc-950 transition-colors hover:bg-zinc-950/[0.04] hover:text-violet-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:text-white dark:hover:bg-white/[0.06] dark:hover:text-violet-300"
                                    href="https://onlyfansapi.com"
                                    target="_blank"
                                    rel="noopener noreferrer sponsored"
                                    aria-label="Visit OnlyFans API, a New Debug Bar sponsor"
                                >
                                    <svg class="size-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="m4 17 6-6-6-6M12 19h8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span class="text-base font-semibold tracking-[-0.025em]">OnlyFans API</span>
                                </a>
                            </li>
                            <li class="hidden h-7 w-px bg-zinc-200 min-[23rem]:block dark:bg-white/10" aria-hidden="true"></li>
                            <li>
                                <a
                                    class="inline-flex min-h-10 min-w-32 items-center justify-center rounded-full bg-zinc-950/[0.04] px-4 text-sm font-medium text-zinc-600 transition-[background-color,color] hover:bg-zinc-950/[0.07] hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:bg-white/[0.06] dark:text-zinc-400 dark:hover:bg-white/[0.1] dark:hover:text-white"
                                    href="https://github.com/sponsors/benjamincrozat"
                                    aria-label="Sponsor New Debug Bar and add your logo"
                                >
                                    Your logo here
                                </a>
                            </li>
                        </ul>
                    </div>

                    <p class="mt-4 text-sm font-medium leading-6 text-zinc-700 sm:mt-5 dark:text-zinc-300">
                        Laravel 10+ and PHP 8.1+
                    </p>
                </div>

                <div class="mt-8 h-[clamp(18rem,22vw,20rem)] w-full overflow-visible px-[clamp(3rem,6vw,6rem)] [clip-path:inset(-6rem_-6rem_0)] max-[79.999rem]:h-[clamp(17rem,28vw,19rem)] max-[47.999rem]:mt-6 max-[47.999rem]:h-[clamp(15rem,82vw,19rem)] max-[47.999rem]:px-0">
                    <div class="relative mx-auto w-[calc(100%_-_1rem)] min-w-0 before:absolute before:inset-[12%_7%_5%] before:z-[-1] before:rounded-[50%] before:bg-[rgb(124_58_237_/_16%)] before:blur-[5rem] before:content-[''] max-[79.999rem]:w-full max-[47.999rem]:w-[min(28rem,calc(100%_+_0.5rem))] max-[47.999rem]:before:inset-[16%_0_8%] max-[47.999rem]:before:blur-[3.5rem]">
                        <x-screenshots.request-inspector
                            alt="New Debug Bar request inspector showing the request trace, route, controller, response, query count, and duration for a Kyoto trip page"
                            fetchpriority="high"
                        />
                    </div>
                </div>
            </section>
    </main>
</x-layouts.site>
