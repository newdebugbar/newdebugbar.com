{{-- Sponsorship and freelance paths presented as full homepage sections. --}}

@php
    $sponsorUrl = 'https://github.com/sponsors/benjamincrozat';
    $hireUrl = 'https://benjamincrozat.com';
    $sponsorPoints = [
        'Expand and refine Laravel diagnostics',
        'Improve browser and agent workflows',
        'Maintain compatibility and fix reported issues',
    ];
@endphp

<div data-support-options="featured">
    <section
        class="border-b border-zinc-950/[0.08] bg-zinc-50 px-5 py-16 sm:px-8 sm:py-20 lg:px-10 lg:py-24 dark:border-white/[0.08] dark:bg-[#09090c]"
        aria-labelledby="project-sponsorship-title"
        data-support-section="sponsor"
    >
        <div class="mx-auto grid max-w-[76rem] gap-10 lg:grid-cols-[minmax(0,0.9fr)_minmax(0,1.1fr)] lg:gap-20">
            <header class="max-w-[34rem]">
                <h2 id="project-sponsorship-title" class="text-balance text-3xl font-semibold tracking-[-0.045em] text-zinc-950 sm:text-4xl lg:text-[2.75rem] lg:leading-[1.05] dark:text-white">
                    Sponsor open-source development
                </h2>
                <p class="mt-5 text-base leading-7 text-zinc-600 sm:text-lg sm:leading-8 dark:text-zinc-300">
                    If your company builds with Laravel, sponsorship directly funds the work that keeps the project useful.
                </p>
                <a
                    class="group mt-8 inline-flex min-h-14 w-fit items-center gap-4 rounded-full bg-gradient-to-r from-violet-700 via-violet-600 to-violet-500 py-2 pr-2.5 pl-5 text-white shadow-[0_16px_32px_-18px_rgba(109,40,217,0.9)] ring-1 ring-white/15 transition-[transform,box-shadow] hover:-translate-y-0.5 hover:shadow-[0_20px_38px_-18px_rgba(109,40,217,0.95)] focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-500 motion-reduce:transform-none dark:focus-visible:outline-violet-300"
                    href="{{ $sponsorUrl }}"
                    data-support-option="sponsor"
                >
                    <span class="text-left">
                        <span class="block text-base leading-5 font-semibold">Sponsor the project</span>
                        <span class="mt-0.5 block text-xs leading-4 font-medium text-violet-100">via GitHub Sponsors</span>
                    </span>
                    <span class="flex size-9 shrink-0 items-center justify-center rounded-full bg-white/15 ring-1 ring-white/20 transition-transform group-hover:translate-x-0.5 motion-reduce:transform-none" aria-hidden="true">
                        <svg class="size-4" viewBox="0 0 16 16" fill="none">
                            <path d="M3.5 8h9M9 4.5 12.5 8 9 11.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </a>
            </header>

            <div class="min-w-0 lg:pt-1">
                <ul class="divide-y divide-zinc-950/10 border-y border-zinc-950/10 dark:divide-white/10 dark:border-white/10" role="list">
                    @foreach ($sponsorPoints as $point)
                        <li class="flex items-start gap-4 py-5 sm:py-6">
                            <span class="mt-[0.6rem] size-2 shrink-0 rounded-full bg-violet-600 dark:bg-violet-400" aria-hidden="true"></span>
                            <span class="text-lg leading-7 font-medium tracking-[-0.02em] text-zinc-900 sm:text-xl dark:text-zinc-100">{{ $point }}</span>
                        </li>
                    @endforeach
                </ul>
                <p class="mt-5 max-w-[34rem] text-sm leading-6 text-zinc-500 dark:text-zinc-400">
                    Company tiers can also include recognition across the project.
                </p>
            </div>
        </div>
    </section>

    <section
        class="border-b border-zinc-950/[0.08] bg-white px-5 py-16 sm:px-8 sm:py-20 lg:px-10 lg:py-24 dark:border-white/[0.08] dark:bg-[#0b0a10]"
        aria-labelledby="project-freelance-title"
        data-support-section="hire"
    >
        <div class="mx-auto grid max-w-[76rem] gap-10 lg:grid-cols-[minmax(0,0.72fr)_minmax(0,1.28fr)] lg:items-start lg:gap-20">
            <div class="flex items-center gap-5 lg:flex-col lg:items-end lg:text-right">
                <img
                    class="size-24 shrink-0 rounded-[1.75rem] object-cover object-[50%_18%] ring-1 ring-zinc-950/10 sm:size-28 lg:size-40 dark:ring-white/15"
                    src="{{ Illuminate\Support\Facades\Vite::asset('resources/images/people/benjamin-crozat.webp') }}"
                    alt=""
                    width="512"
                    height="770"
                    loading="lazy"
                    decoding="async"
                >
                <div class="min-w-0 lg:mt-5 lg:flex lg:flex-col lg:items-end">
                    <p class="text-lg font-semibold tracking-[-0.025em] text-zinc-950 dark:text-white">Benjamin Crozat</p>
                    <p class="mt-1 max-w-[17rem] text-sm leading-6 text-zinc-600 dark:text-zinc-400">Laravel delivery, product thinking, and technical leadership</p>
                </div>
            </div>

            <div class="min-w-0">
                <h2 id="project-freelance-title" class="max-w-[46rem] text-balance text-3xl font-semibold tracking-[-0.045em] text-zinc-950 sm:text-4xl lg:text-[2.75rem] lg:leading-[1.05] dark:text-white">
                    Bring senior Laravel leadership to your team
                </h2>
                <p class="mt-5 max-w-[44rem] text-base leading-7 text-zinc-600 sm:text-lg sm:leading-8 dark:text-zinc-300">
                    I bring more than 10 years of professional web development experience, combining hands-on delivery with a strong business and product mindset.
                </p>

                <p class="mt-7 max-w-[43rem] border-t border-zinc-950/10 pt-5 text-base leading-7 font-medium text-zinc-900 dark:border-white/10 dark:text-zinc-100">
                    I take ownership of difficult Laravel work, turn business needs into practical product and technical decisions, and help your team ship with confidence.
                </p>

                <a
                    class="group mt-8 inline-flex min-h-14 w-fit items-center gap-4 rounded-full bg-zinc-950 py-2 pr-2.5 pl-5 text-white shadow-[0_16px_32px_-20px_rgba(24,24,27,0.75)] ring-1 ring-zinc-950/10 transition-[transform,background-color,box-shadow] hover:-translate-y-0.5 hover:bg-zinc-800 hover:shadow-[0_20px_38px_-20px_rgba(24,24,27,0.8)] focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-500 motion-reduce:transform-none dark:bg-white dark:text-zinc-950 dark:ring-white/20 dark:hover:bg-zinc-200 dark:focus-visible:outline-violet-300"
                    href="{{ $hireUrl }}"
                    data-support-option="hire"
                >
                    <span class="text-left">
                        <span class="block text-base leading-5 font-semibold">See how I can help</span>
                        <span class="mt-0.5 block text-xs leading-4 font-medium text-zinc-400 dark:text-zinc-600">Laravel consulting and leadership</span>
                    </span>
                    <span class="flex size-9 shrink-0 items-center justify-center rounded-full bg-violet-600 text-white shadow-sm transition-transform group-hover:translate-x-0.5 motion-reduce:transform-none" aria-hidden="true">
                        <svg class="size-4" viewBox="0 0 16 16" fill="none">
                            <path d="M3.5 8h9M9 4.5 12.5 8 9 11.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </section>
</div>
