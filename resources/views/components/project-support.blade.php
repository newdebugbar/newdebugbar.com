{{-- Shared support choices for the homepage and documentation articles. --}}
@props(['variant' => 'featured'])

@php
    $sponsorUrl = 'https://github.com/sponsors/benjamincrozat';
    $hireUrl = 'https://benjamincrozat.com';
@endphp

@if ($variant === 'featured')
    <section
        class="relative overflow-hidden border-b border-white/10 bg-[#111116] text-white [background:radial-gradient(circle_at_82%_18%,rgb(124_58_237_/_18%),transparent_25rem),#111116]"
        aria-labelledby="project-support-title"
        data-support-options="featured"
    >
        <div class="mx-auto grid max-w-[76rem] gap-10 px-5 py-16 sm:px-8 sm:py-20 lg:grid-cols-[minmax(0,0.72fr)_minmax(0,1.28fr)] lg:items-center lg:gap-14 lg:px-10 lg:py-24">
            <div class="max-w-xl">
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-violet-300">Support the project</p>
                <h2 id="project-support-title" class="mt-4 text-balance text-3xl font-semibold tracking-[-0.045em] sm:text-4xl">
                    Keep New Debug Bar moving.
                </h2>
                <p class="mt-5 text-base leading-7 text-zinc-300 sm:text-lg sm:leading-8">
                    New Debug Bar is free and open source. Sponsor ongoing work, or hire me to help with your Laravel product.
                </p>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <article class="flex min-w-0 flex-col rounded-[1.75rem] border border-violet-400/25 bg-violet-400/[0.08] p-6 shadow-[0_1.5rem_4rem_rgb(0_0_0/0.18)] sm:p-7">
                    <div class="grid size-14 place-items-center rounded-2xl bg-violet-400/15 text-violet-200 ring-1 ring-inset ring-violet-300/15">
                        <svg class="size-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 20.25S4.75 16.1 4.75 9.9A4.15 4.15 0 0 1 12 7.1a4.15 4.15 0 0 1 7.25 2.8C19.25 16.1 12 20.25 12 20.25Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>

                    <h3 class="mt-6 text-xl font-semibold tracking-[-0.03em]">Sponsor New Debug Bar</h3>
                    <p class="mt-3 text-sm leading-6 text-zinc-300">
                        Help fund maintenance, documentation, and new debugging tools for the Laravel community.
                    </p>

                    <a
                        class="mt-7 inline-flex min-h-11 w-fit items-center gap-2 rounded-xl bg-violet-500 px-4 text-sm font-semibold text-white transition-colors hover:bg-violet-400 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-300 sm:mt-auto"
                        href="{{ $sponsorUrl }}"
                        data-support-option="sponsor"
                    >
                        Sponsor on GitHub
                        <svg class="size-4" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                            <path d="M3.5 8h9M9 4.5 12.5 8 9 11.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </article>

                <article class="flex min-w-0 flex-col rounded-[1.75rem] border border-white/10 bg-white/[0.045] p-6 shadow-[0_1.5rem_4rem_rgb(0_0_0/0.18)] sm:p-7">
                    <img
                        class="size-14 rounded-2xl object-cover object-[50%_18%] ring-1 ring-white/15"
                        src="{{ Illuminate\Support\Facades\Vite::asset('resources/images/people/benjamin-crozat.webp') }}"
                        alt="Benjamin Crozat"
                        width="512"
                        height="770"
                        loading="lazy"
                        decoding="async"
                    >

                    <h3 class="mt-6 text-xl font-semibold tracking-[-0.03em]">Hire me for Laravel work</h3>
                    <p class="mt-3 text-sm leading-6 text-zinc-300">
                        Need hands-on help? I am available for freelance Laravel development.
                    </p>

                    <a
                        class="mt-7 inline-flex min-h-11 w-fit items-center gap-2 rounded-xl border border-white/15 bg-white/[0.06] px-4 text-sm font-semibold text-white transition-colors hover:bg-white/[0.11] focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-300 sm:mt-auto"
                        href="{{ $hireUrl }}"
                        data-support-option="hire"
                    >
                        Hire Benjamin
                        <svg class="size-4" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                            <path d="M3.5 8h9M9 4.5 12.5 8 9 11.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </article>
            </div>
        </div>
    </section>
@elseif ($variant === 'compact')
    <aside
        class="mt-14 border-t border-zinc-950/[0.08] pt-8 dark:border-white/[0.1]"
        aria-labelledby="documentation-support-title"
        data-support-options="compact"
    >
        <div class="grid gap-5 rounded-2xl border border-zinc-950/[0.08] bg-zinc-50/80 p-5 sm:grid-cols-[minmax(0,1fr)_auto] sm:items-center sm:p-6 dark:border-white/[0.1] dark:bg-white/[0.035]">
            <div class="min-w-0">
                <h2 id="documentation-support-title" class="text-base font-semibold tracking-[-0.02em] text-zinc-950 dark:text-white">
                    Support New Debug Bar
                </h2>
                <p class="mt-2 text-sm leading-6 text-zinc-600 dark:text-zinc-400">
                    If it saves you time, help fund the project—or hire Benjamin for hands-on Laravel work.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-x-5 gap-y-1 sm:justify-end">
                <a
                    class="inline-flex min-h-10 items-center gap-1.5 text-sm font-semibold text-violet-700 transition-colors hover:text-violet-900 focus-visible:rounded-sm focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-500 dark:text-violet-300 dark:hover:text-violet-200"
                    href="{{ $sponsorUrl }}"
                    data-support-option="sponsor"
                >
                    Sponsor
                    <svg class="size-3.5" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                        <path d="M3.5 8h9M9 4.5 12.5 8 9 11.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <a
                    class="inline-flex min-h-10 items-center gap-1.5 text-sm font-semibold text-zinc-700 transition-colors hover:text-zinc-950 focus-visible:rounded-sm focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-500 dark:text-zinc-300 dark:hover:text-white"
                    href="{{ $hireUrl }}"
                    data-support-option="hire"
                >
                    Hire Benjamin
                    <svg class="size-3.5" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                        <path d="M3.5 8h9M9 4.5 12.5 8 9 11.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        </div>
    </aside>
@endif
