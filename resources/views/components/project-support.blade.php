{{-- Separate paths to sponsor the project or work with its creator. --}}

@php
    $sponsorPoints = [
        ['title' => 'Deeper diagnostics', 'description' => 'More ways to understand slow requests, find bugs, and see what happened.'],
        ['title' => 'Better workflows', 'description' => 'A clearer browser inspector and exact debugging context for coding agents through MCP.'],
        ['title' => 'Ongoing care', 'description' => 'Time for reported issues, maintenance, and new Laravel and PHP releases.'],
    ];
    $freelancePoints = [
        ['title' => 'Product direction', 'description' => 'Turn business needs into clear priorities.'],
        ['title' => 'Laravel development', 'description' => 'Build, improve, and launch your application.'],
        ['title' => 'Technical leadership', 'description' => 'Make decisions and keep delivery moving.'],
    ];
@endphp

<div data-support-options="featured">
    <section
        class="border-b border-zinc-950/[0.08] bg-zinc-50 px-5 py-16 sm:px-8 sm:py-20 lg:px-10 lg:py-24 dark:border-white/[0.08] dark:bg-[#09090c]"
        aria-labelledby="project-sponsorship-title"
        data-support-section="sponsor"
    >
        <div class="mx-auto grid max-w-[76rem] gap-12 lg:grid-cols-[minmax(0,0.9fr)_minmax(0,1.1fr)] lg:gap-24">
            <header class="max-w-[31rem]">
                <p class="text-xs font-semibold tracking-[0.16em] text-violet-700 uppercase dark:text-violet-400">Sponsorship</p>
                <h2 id="project-sponsorship-title" class="mt-4 text-balance text-4xl leading-[1.08] font-semibold tracking-[-0.045em] text-zinc-950 sm:text-5xl dark:text-white">
                    Help build what’s next.
                </h2>
                <p class="mt-5 text-base leading-7 text-zinc-600 sm:text-lg sm:leading-8 dark:text-zinc-400">
                    Sponsorship gives me more time to improve the New Debug Bar for the Laravel teams who use it.
                </p>
                <div class="mt-8 flex flex-wrap items-center gap-x-4 gap-y-3">
                    <a
                        class="inline-flex min-h-12 items-center justify-center gap-3 rounded-xl bg-violet-700 py-3 pr-4 pl-5 text-sm font-semibold text-white transition-colors hover:bg-violet-800 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-600 dark:bg-violet-600 dark:hover:bg-violet-700 dark:focus-visible:outline-violet-400"
                        href="https://github.com/sponsors/benjamincrozat"
                        data-support-option="sponsor"
                    >
                        Sponsor the project
                        <svg class="size-5 shrink-0" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                            <path d="M5 15 15 5M5 5h10v10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <span class="text-sm text-zinc-500 dark:text-zinc-400">via GitHub Sponsors</span>
                </div>
            </header>

            <ul class="divide-y divide-zinc-950/10 border-y border-zinc-950/10 dark:divide-white/10 dark:border-white/10" role="list">
                @foreach ($sponsorPoints as $point)
                    <li class="grid gap-2 py-6 sm:grid-cols-[10rem_minmax(0,1fr)] sm:gap-6 lg:py-7">
                        <h3 class="text-base leading-7 font-semibold tracking-[-0.02em] text-zinc-950 dark:text-white">{{ $point['title'] }}</h3>
                        <p class="text-base leading-7 text-zinc-600 dark:text-zinc-400">{{ $point['description'] }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <section
        class="border-b border-zinc-950/[0.08] bg-white px-5 py-16 sm:px-8 sm:py-20 lg:px-10 lg:py-24 dark:border-white/[0.08] dark:bg-[#0b0a10]"
        aria-labelledby="project-freelance-title"
        data-support-section="hire"
    >
        <div class="mx-auto grid max-w-[76rem] gap-10 lg:grid-cols-[minmax(0,0.65fr)_minmax(0,1.35fr)] lg:items-center lg:gap-24">
            <figure class="flex items-center gap-4 lg:block">
                <img
                    class="size-20 shrink-0 rounded-2xl object-cover object-[50%_25%] sm:size-24 lg:aspect-[4/5] lg:h-auto lg:w-full lg:max-w-72 lg:rounded-3xl"
                    src="{{ Illuminate\Support\Facades\Vite::asset('resources/images/people/benjamin-crozat.webp') }}"
                    alt=""
                    width="512"
                    height="770"
                    loading="lazy"
                    decoding="async"
                >
                <figcaption class="lg:mt-5">
                    <p class="text-base font-semibold tracking-[-0.02em] text-zinc-950 dark:text-white">Benjamin Crozat</p>
                    <p class="mt-1 text-sm leading-6 text-zinc-600 dark:text-zinc-400">Creator of the New Debug Bar</p>
                </figcaption>
            </figure>

            <div class="min-w-0">
                <p class="text-xs font-semibold tracking-[0.16em] text-violet-700 uppercase dark:text-violet-400">Available for new projects</p>
                <h2 id="project-freelance-title" class="mt-4 max-w-[42rem] text-balance text-4xl leading-[1.08] font-semibold tracking-[-0.045em] text-zinc-950 sm:text-5xl dark:text-white">
                    Hire me as a freelancer.
                </h2>
                <p class="mt-5 max-w-[42rem] text-base leading-7 text-zinc-600 sm:text-lg sm:leading-8 dark:text-zinc-400">
                    I bring more than 10 years of professional web development experience to your team. I connect business goals with product decisions and hands-on Laravel delivery.
                </p>

                <ul class="mt-8 grid gap-5 border-t border-zinc-950/10 pt-6 sm:grid-cols-3 sm:gap-6 dark:border-white/10" role="list">
                    @foreach ($freelancePoints as $point)
                        <li>
                            <h3 class="text-sm leading-6 font-semibold text-zinc-950 dark:text-white">{{ $point['title'] }}</h3>
                            <p class="mt-1 text-sm leading-6 text-zinc-600 dark:text-zinc-400">{{ $point['description'] }}</p>
                        </li>
                    @endforeach
                </ul>

                <a
                    class="mt-8 inline-flex max-w-full flex-col gap-1 rounded-sm py-1 text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-600 dark:text-white dark:focus-visible:outline-violet-400"
                    href="mailto:hello@benjamincrozat.com"
                    data-support-option="hire"
                >
                    <span class="inline-flex items-center gap-3 text-base leading-7 font-semibold">
                        <span class="underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:decoration-violet-500 dark:hover:decoration-violet-300">Email me about your project</span>
                        <svg class="size-5 shrink-0 text-violet-700 dark:text-violet-400" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                            <path d="M4.5 10h11m-4-4 4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <span class="text-sm leading-6 text-zinc-600 dark:text-zinc-400">hello@benjamincrozat.com</span>
                </a>
            </div>
        </div>
    </section>
</div>
