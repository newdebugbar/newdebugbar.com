@php
    $roadmapGroups = [
        [
            'id' => 'requests-and-performance',
            'title' => 'Requests and performance',
            'items' => [
                [
                    'title' => 'Searchable retained history',
                    'description' => 'Find every retained page, API, command, test, and worker profile from the browser.',
                ],
                [
                    'title' => 'Cross-request comparison',
                    'description' => 'Compare duration, queries, failures, and section activity between two profiles.',
                ],
                [
                    'title' => 'Failed query capture',
                    'description' => 'Show failed SQL with its bindings, connection, exception, and application source.',
                ],
                [
                    'title' => 'Causal performance breakdown',
                    'description' => 'Explain where request time went across captured layers without counting the same work twice.',
                ],
                [
                    'title' => 'Request-level capture rules',
                    'description' => 'Let an app decide whether to capture one request after route and authentication context is known.',
                ],
            ],
        ],
        [
            'id' => 'laravel-ecosystem',
            'title' => 'Laravel ecosystem',
            'items' => [
                [
                    'title' => 'Inertia inspector',
                    'description' => 'Inspect components, props, partial or deferred data, and the application source behind a response.',
                ],
                [
                    'title' => 'Laravel AI inspector',
                    'description' => 'Inspect agents, providers, models, token use, tool calls, and failures.',
                ],
                [
                    'title' => 'Pennant inspector',
                    'description' => 'See which feature flags were evaluated and the value each request received.',
                ],
            ],
        ],
        [
            'id' => 'developer-workflow',
            'title' => 'Developer workflow',
            'items' => [
                [
                    'title' => 'Custom diagnostics API',
                    'description' => 'Add application messages, timers, measurements, and manually reported exceptions.',
                ],
                [
                    'title' => 'Controlled collector extensions',
                    'description' => 'Let packages add bounded inspector sections while keeping redaction and MCP access intact.',
                ],
                [
                    'title' => 'Editor navigation and path mapping',
                    'description' => 'Open captured source in a local editor even when Laravel runs in Docker or on a remote machine.',
                ],
                [
                    'title' => 'Server-Timing headers',
                    'description' => 'Expose useful request timing in browser developer tools without opening the inspector.',
                ],
            ],
        ],
    ];

    $roadmapIndex = 0;
@endphp

<section
    class="border-b border-zinc-950/[0.08] bg-white px-5 py-16 sm:px-8 sm:py-20 lg:px-10 lg:py-24 dark:border-white/[0.08] dark:bg-[#07070a]"
    aria-labelledby="project-roadmap-title"
    data-project-roadmap
>
    <div class="mx-auto grid max-w-[76rem] gap-12 lg:grid-cols-[minmax(0,0.72fr)_minmax(0,1.28fr)] lg:gap-20">
        <header class="max-w-[32rem]">
            <h2 id="project-roadmap-title" class="text-balance text-3xl font-semibold tracking-[-0.045em] sm:text-4xl lg:text-[2.75rem] lg:leading-[1.05]">
                Roadmap
            </h2>
            <p class="mt-5 text-base leading-7 text-zinc-600 sm:text-lg sm:leading-8 dark:text-zinc-300">
                Here’s what could make the New Debug Bar even better.
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

        <div class="space-y-11">
            @foreach ($roadmapGroups as $group)
                <section aria-labelledby="roadmap-group-{{ $group['id'] }}">
                    <h3 id="roadmap-group-{{ $group['id'] }}" class="text-xs font-semibold uppercase tracking-[0.16em] text-zinc-500 dark:text-zinc-500">
                        {{ $group['title'] }}
                    </h3>

                    <ol class="mt-4 grid gap-x-10 gap-y-8 sm:grid-cols-2" role="list">
                        @foreach ($group['items'] as $item)
                            @php($roadmapIndex++)
                            <li class="grid min-w-0 grid-cols-[auto_minmax(0,1fr)] gap-4 border-t border-zinc-950/10 pt-5 dark:border-white/10" data-roadmap-item>
                                <span class="flex size-8 items-center justify-center rounded-full border border-violet-200 bg-violet-50 font-mono text-xs font-medium leading-none tabular-nums text-violet-700 dark:border-white/15 dark:bg-white/5 dark:text-violet-300" aria-hidden="true">
                                    {{ str_pad((string) $roadmapIndex, 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <div class="min-w-0">
                                    <h4 class="text-lg leading-8 font-semibold tracking-[-0.025em]">{{ $item['title'] }}</h4>
                                    <p class="mt-2 text-sm leading-6 text-zinc-600 dark:text-zinc-400">{{ $item['description'] }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                </section>
            @endforeach
        </div>
    </div>
</section>
