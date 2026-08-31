{{-- Shared support choices for the homepage and documentation articles. --}}
@props(['variant' => 'featured'])

@php
    $sponsorUrl = 'https://github.com/sponsors/benjamincrozat';
    $hireUrl = 'https://benjamincrozat.com';
    $sponsorPoints = [
        'Expand and refine Laravel diagnostics',
        'Improve browser and agent workflows',
        'Maintain compatibility and fix reported issues',
    ];
    $hirePoints = [
        'Take ownership of difficult work',
        'Guide technical decisions',
        'Help your team ship with confidence',
    ];
@endphp

@if ($variant === 'featured')
    <section
        class="border-b border-zinc-950/[0.08] bg-zinc-50 px-5 py-16 sm:px-8 sm:py-20 lg:px-10 lg:py-24 dark:border-white/[0.08] dark:bg-[#09090c]"
        aria-labelledby="project-support-title"
        data-support-options="featured"
    >
        <div class="mx-auto max-w-[68rem] overflow-hidden rounded-[1.75rem] border border-zinc-950/10 bg-white text-zinc-950 shadow-[0_28px_80px_-56px_rgba(24,24,27,0.4)] dark:border-white/10 dark:bg-[#111116] dark:text-white dark:shadow-none">
            <div class="min-w-0 p-7 sm:p-10 lg:p-12 xl:p-14">
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-violet-700 dark:text-violet-300">Support the New Debug Bar</p>
                <h2 id="project-support-title" class="mt-4 max-w-[48rem] text-balance text-3xl font-semibold tracking-[-0.045em] sm:text-4xl lg:text-[2.75rem] lg:leading-[1.05]">
                    Invest in better Laravel debugging.
                </h2>
                <p class="mt-5 max-w-[44rem] text-base leading-7 text-zinc-600 sm:text-lg sm:leading-8 dark:text-zinc-300">
                    The New Debug Bar is free and open source. Companies can fund its continued development—or work with me directly when their own Laravel projects need senior delivery and technical leadership.
                </p>

                <div class="mt-10 grid gap-8 border-t border-zinc-950/10 pt-8 sm:grid-cols-2 sm:gap-0 dark:border-white/10">
                    <article class="flex min-w-0 flex-col sm:pr-10">
                        <div>
                            <h3 class="text-lg font-semibold tracking-[-0.025em]">Sponsor open-source development</h3>
                            <p class="mt-3 text-sm leading-6 text-zinc-600 dark:text-zinc-400">If your company builds with Laravel, sponsorship directly funds the work that keeps the project useful:</p>
                            <x-support-points :points="$sponsorPoints" />
                            <p class="mt-4 text-xs leading-5 text-zinc-500 dark:text-zinc-400">Company tiers can also include recognition across the project.</p>
                        </div>

                        <div class="mt-auto pt-7">
                            <a
                                class="inline-flex min-h-11 w-fit items-center gap-2 rounded-xl bg-violet-600 px-4 text-sm font-semibold text-white transition-colors hover:bg-violet-500 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-500 dark:bg-violet-500 dark:hover:bg-violet-400 dark:focus-visible:outline-violet-300"
                                href="{{ $sponsorUrl }}"
                                data-support-option="sponsor"
                            >
                                Sponsor on GitHub
                                <svg class="size-4" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                                    <path d="M3.5 8h9M9 4.5 12.5 8 9 11.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                    </article>

                    <article class="flex min-w-0 flex-col border-t border-zinc-950/10 pt-8 sm:border-t-0 sm:border-l sm:pt-0 sm:pl-10 dark:border-white/10">
                        <div>
                            <div class="flex items-center gap-4">
                                <img
                                    class="size-14 shrink-0 rounded-2xl object-cover object-[50%_18%] ring-1 ring-zinc-950/10 dark:ring-white/15"
                                    src="{{ Illuminate\Support\Facades\Vite::asset('resources/images/people/benjamin-crozat.webp') }}"
                                    alt=""
                                    width="512"
                                    height="770"
                                    loading="lazy"
                                    decoding="async"
                                >
                                <h3 class="text-lg font-semibold tracking-[-0.025em]">Bring senior Laravel leadership to your team</h3>
                            </div>
                            <p class="mt-3 text-sm leading-6 text-zinc-600 dark:text-zinc-400">
                                I bring more than 10 years of professional web development experience to companies that need both delivery and direction.
                            </p>
                            <x-support-points :points="$hirePoints" />
                        </div>

                        <div class="mt-auto pt-7">
                            <a
                                class="inline-flex min-h-11 w-fit items-center gap-2 rounded-xl border border-zinc-950/10 bg-zinc-950/[0.04] px-4 text-sm font-semibold text-zinc-900 transition-colors hover:bg-zinc-950/[0.08] focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-500 dark:border-white/15 dark:bg-white/[0.06] dark:text-white dark:hover:bg-white/[0.11] dark:focus-visible:outline-violet-300"
                                href="{{ $hireUrl }}"
                                data-support-option="hire"
                            >
                                Hire Benjamin
                                <svg class="size-4" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                                    <path d="M3.5 8h9M9 4.5 12.5 8 9 11.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
@elseif ($variant === 'compact')
    <aside
        class="relative isolate mt-16 overflow-hidden rounded-[1.5rem] border border-violet-200/80 bg-[radial-gradient(circle_at_top_right,rgba(139,92,246,0.16),transparent_44%),linear-gradient(135deg,#ffffff_0%,#f7f4ff_100%)] p-6 text-zinc-950 shadow-[0_20px_55px_-40px_rgba(88,28,135,0.5)] sm:p-8 dark:border-violet-400/20 dark:bg-[radial-gradient(circle_at_top_right,rgba(139,92,246,0.22),transparent_42%),linear-gradient(135deg,#18151f_0%,#111116_62%)] dark:text-white dark:shadow-none"
        aria-labelledby="documentation-support-title"
        data-support-options="compact"
    >
        <div class="absolute inset-x-8 top-0 h-px bg-gradient-to-r from-transparent via-violet-500/70 to-transparent" aria-hidden="true"></div>

        <div class="relative grid gap-7 sm:grid-cols-[minmax(0,1fr)_16rem] sm:gap-8">
            <div class="min-w-0">
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-violet-700 dark:text-violet-300">Support the work</p>
                <h2 id="documentation-support-title" class="mt-3 max-w-[24rem] text-2xl font-semibold tracking-[-0.035em] sm:text-[1.75rem] sm:leading-[1.12]">
                    Help build better Laravel debugging.
                </h2>
                <p class="mt-3 max-w-[27rem] text-sm leading-6 text-zinc-600 dark:text-zinc-300">
                    Sponsorship funds new diagnostics, better browser and agent workflows, compatibility work, and fixes for issues reported by the community.
                </p>

                <div class="pt-7">
                    <a
                        class="inline-flex min-h-11 items-center gap-2 rounded-xl bg-violet-600 px-4 text-sm font-semibold text-white transition-colors hover:bg-violet-500 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-500 dark:bg-violet-500 dark:hover:bg-violet-400 dark:focus-visible:outline-violet-300"
                        href="{{ $sponsorUrl }}"
                        data-support-option="sponsor"
                    >
                        Sponsor on GitHub
                        <svg class="size-4" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                            <path d="M3.5 8h9M9 4.5 12.5 8 9 11.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="border-t border-zinc-950/10 pt-6 sm:border-t-0 sm:border-l sm:pt-0 sm:pl-8 dark:border-white/10">
                <p class="text-sm font-semibold">Need senior Laravel leadership?</p>
                <p class="mt-2 text-sm leading-5 text-zinc-600 dark:text-zinc-400">I bring more than 10 years of professional web development experience, combining hands-on Laravel delivery with technical direction.</p>
                <x-support-points :points="$hirePoints" compact />

                <div class="pt-7">
                    <a
                        class="inline-flex min-h-11 items-center gap-2 rounded-xl border border-violet-300/80 bg-white/70 px-4 text-sm font-semibold text-violet-800 transition-colors hover:bg-white focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-500 dark:border-white/15 dark:bg-white/[0.06] dark:text-white dark:hover:bg-white/[0.11] dark:focus-visible:outline-violet-300"
                        href="{{ $hireUrl }}"
                        data-support-option="hire"
                    >
                        Hire Benjamin
                        <svg class="size-4" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                            <path d="M3.5 8h9M9 4.5 12.5 8 9 11.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </aside>
@endif
