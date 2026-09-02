@php
    $roadmapItems = [
        [
            'title' => 'Searchable request history',
            'description' => 'Open and search retained requests after leaving the original page.',
        ],
        [
            'title' => 'Failed query capture',
            'description' => 'Show failed SQL beside successful queries, with the source that triggered it.',
        ],
        [
            'title' => 'Request-level control',
            'description' => 'Let an app enable or disable capture for one request using its own rules.',
        ],
        [
            'title' => 'Inertia inspector',
            'description' => 'Inspect the page component, props, and application source behind a response.',
        ],
        [
            'title' => 'Laravel AI and Pennant',
            'description' => 'See agent and tool activity alongside the feature values evaluated during a request.',
        ],
        [
            'title' => 'Extension APIs',
            'description' => 'Add custom messages, timers, exceptions, and controlled collectors.',
        ],
    ];
@endphp

<section
    class="border-b border-zinc-950/[0.08] bg-white px-5 py-16 sm:px-8 sm:py-20 lg:px-10 lg:py-24 dark:border-white/[0.08] dark:bg-[#07070a]"
    aria-labelledby="project-roadmap-title"
    data-project-roadmap
>
    <div class="mx-auto grid max-w-[76rem] gap-12 lg:grid-cols-[minmax(0,0.72fr)_minmax(0,1.28fr)] lg:gap-20">
        <header class="max-w-[32rem]">
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-violet-700 dark:text-violet-300">Considering</p>
            <h2 id="project-roadmap-title" class="mt-4 text-balance text-3xl font-semibold tracking-[-0.045em] sm:text-4xl lg:text-[2.75rem] lg:leading-[1.05]">
                What comes next.
            </h2>
            <p class="mt-5 text-base leading-7 text-zinc-600 sm:text-lg sm:leading-8 dark:text-zinc-300">
                The roadmap stays open by design. These are the main gaps being considered, not promised release dates.
            </p>
            <a
                class="mt-7 inline-flex min-h-11 items-center gap-2 text-sm font-semibold text-violet-700 underline decoration-violet-300 underline-offset-4 transition-colors hover:text-violet-900 hover:decoration-violet-500 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-500 dark:text-violet-300 dark:decoration-violet-500/60 dark:hover:text-violet-200 dark:hover:decoration-violet-300 dark:focus-visible:outline-violet-300"
                href="https://github.com/newdebugbar/newdebugbar/blob/main/ROADMAP.md"
                data-roadmap-source
            >
                View the roadmap on GitHub
                <svg class="size-4" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                    <path d="M3.5 8h9M9 4.5 12.5 8 9 11.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </header>

        <ol class="grid gap-x-10 gap-y-8 sm:grid-cols-2" role="list">
            @foreach ($roadmapItems as $item)
                <li class="grid min-w-0 grid-cols-[auto_minmax(0,1fr)] gap-4 border-t border-zinc-950/10 pt-5 dark:border-white/10" data-roadmap-item>
                    <span class="font-mono text-sm font-medium tabular-nums text-violet-700 dark:text-violet-300" aria-hidden="true">
                        {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                    </span>
                    <div class="min-w-0">
                        <h3 class="text-lg font-semibold tracking-[-0.025em]">{{ $item['title'] }}</h3>
                        <p class="mt-2 text-sm leading-6 text-zinc-600 dark:text-zinc-400">{{ $item['description'] }}</p>
                    </div>
                </li>
            @endforeach
        </ol>
    </div>
</section>
