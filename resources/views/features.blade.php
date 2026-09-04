{{-- A searchable reference to the diagnostics and workflows available in the New Debug Bar. --}}
@php
    $collections = config('features', []);
    $featureCount = collect($collections)->sum(fn (array $collection): int => collect($collection['sections'])->sum(fn (array $section): int => count($section['features'])));
    $sectionCount = collect($collections)->sum(fn (array $collection): int => count($collection['sections']));
    $description = 'Explore the New Debug Bar for Laravel: queries, Livewire, requests, mail, queues, MCP tools, and more. Search the complete feature catalogue.';
@endphp

<x-layouts.site
    title="Features — New Debug Bar for Laravel"
    :description="$description"
    :canonical="route('features')"
>
    <main class="border-b border-zinc-200 bg-white dark:border-white/10 dark:bg-[#09090c]" id="features">
        <section class="mx-auto max-w-[76rem] px-5 pt-10 pb-10 sm:px-8 sm:pt-12 lg:px-10 lg:pt-14 lg:pb-12" aria-labelledby="features-title">
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-violet-700 dark:text-violet-400">Features</p>
            <h1 id="features-title" class="mt-4 max-w-4xl text-[2.6rem] leading-[1.08] font-semibold tracking-[-0.055em] text-zinc-950 sm:text-5xl lg:text-6xl dark:text-white">
                Laravel debugging,<br>
                <span class="text-violet-700 dark:text-violet-300">down to the details.</span>
            </h1>
            <div class="mt-6 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between lg:gap-16">
                <p class="max-w-2xl text-base leading-7 text-zinc-600 sm:text-lg sm:leading-8 dark:text-zinc-400">
                    Follow a request, untangle a query, inspect a component, or give your agent the exact context.
                    Explore everything the New Debug Bar puts within reach.
                </p>
                <a class="inline-flex min-h-11 shrink-0 items-center gap-2 self-start rounded-lg text-sm font-semibold text-zinc-950 transition-colors hover:text-violet-700 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-500 dark:text-zinc-200 dark:hover:text-violet-300" href="{{ route('docs.installation') }}">
                    Get started
                    <svg class="size-4" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                        <path d="M4 10h12m-5-5 5 5-5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        </section>

        <div class="group/features [overflow-anchor:none] [&_[hidden]]:hidden" data-feature-catalogue>
            <div class="sticky top-0 z-30 border-y border-zinc-200 bg-white/95 backdrop-blur-xl dark:border-white/10 dark:bg-[#09090c]/95" data-feature-controls hidden>
                <div class="mx-auto max-w-[76rem] px-5 py-4 sm:px-8 lg:px-10 lg:py-5">
                    <form class="grid items-end gap-4 lg:grid-cols-[minmax(0,1fr)_auto] lg:gap-10" role="search" aria-label="Search features" data-feature-search-form>
                        <div class="grid min-w-0 gap-3 sm:grid-cols-[minmax(0,1fr)_13rem] lg:grid-cols-1">
                            <div class="min-w-0">
                                <label for="feature-search" class="mb-2 block text-xs font-medium text-zinc-600 dark:text-zinc-400">Find a feature</label>
                                <div class="relative">
                                    <svg class="pointer-events-none absolute top-1/2 left-3.5 size-5 -translate-y-1/2 text-zinc-400 dark:text-zinc-500" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <circle cx="10.5" cy="10.5" r="6.5" stroke="currentColor" stroke-width="1.7"/>
                                        <path d="m16 16 4.5 4.5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                                    </svg>
                                    <input
                                        class="h-12 w-full min-w-0 rounded-xl border border-zinc-300 bg-zinc-50/70 pr-16 pl-11 text-base text-zinc-950 outline-none placeholder:text-zinc-500 focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 [&::-webkit-search-cancel-button]:appearance-none dark:border-white/15 dark:bg-white/[0.035] dark:text-white dark:placeholder:text-zinc-500 dark:focus:border-violet-400 dark:focus:ring-violet-400/20"
                                        id="feature-search"
                                        type="search"
                                        placeholder="Try SQL, mail, Livewire, or MCP…"
                                        autocomplete="off"
                                        spellcheck="false"
                                        aria-controls="feature-results"
                                        data-feature-search
                                    >
                                    <button class="absolute top-1/2 right-2 flex min-h-9 -translate-y-1/2 items-center rounded-lg px-2 text-xs font-medium text-zinc-600 hover:bg-zinc-200/70 hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-violet-500 dark:text-zinc-400 dark:hover:bg-white/10 dark:hover:text-white" type="button" data-feature-clear hidden>Clear</button>
                                </div>
                            </div>
                            <div class="lg:hidden">
                                <label for="feature-category" class="mb-2 block text-xs font-medium text-zinc-600 dark:text-zinc-400">Browse category</label>
                                <select id="feature-category" class="h-12 w-full rounded-xl border border-zinc-300 bg-white px-3 text-sm text-zinc-950 focus:border-violet-500 focus:outline-2 focus:outline-violet-500 dark:border-white/15 dark:bg-[#15151b] dark:text-white" data-feature-category-select aria-controls="feature-results">
                                    <option value="all">All features</option>
                                    @foreach ($collections as $collection)
                                        <option value="{{ $collection['id'] }}">{{ $collection['label'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <p class="min-h-5 text-xs text-zinc-500 lg:min-w-48 lg:pb-4 lg:text-right dark:text-zinc-400" data-feature-results role="status" aria-live="polite" aria-atomic="true">
                            {{ $featureCount }} features across {{ $sectionCount }} sections
                        </p>
                    </form>
                </div>
            </div>

            <div class="mx-auto grid max-w-[76rem] gap-10 px-5 pt-10 pb-16 sm:px-8 lg:gap-14 lg:px-10 lg:pt-12 lg:pb-24 lg:group-data-[feature-ready]/features:grid-cols-[13rem_minmax(0,1fr)]">
                <aside class="hidden lg:block" data-feature-controls hidden>
                    <div class="sticky top-36">
                        <p class="mb-4 px-3 text-xs font-medium text-zinc-500 dark:text-zinc-400">Browse category</p>
                        <div class="space-y-1" role="group" aria-label="Feature categories">
                            @foreach ([['id' => 'all', 'label' => 'All features', 'sections' => []], ...$collections] as $category)
                                @php
                                    $categoryCount = $category['id'] === 'all'
                                        ? $featureCount
                                        : collect($category['sections'])->sum(fn (array $section): int => count($section['features']));
                                @endphp
                                <button
                                    class="group flex min-h-11 w-full items-center justify-between gap-2 rounded-lg px-3 text-left text-sm font-medium text-zinc-600 transition-colors hover:bg-zinc-100 hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 aria-pressed:bg-violet-50 aria-pressed:text-violet-800 dark:text-zinc-400 dark:hover:bg-white/[0.05] dark:hover:text-white dark:aria-pressed:bg-violet-400/10 dark:aria-pressed:text-violet-300"
                                    type="button"
                                    data-feature-category="{{ $category['id'] }}"
                                    aria-pressed="{{ $category['id'] === 'all' ? 'true' : 'false' }}"
                                    aria-controls="feature-results"
                                >
                                    <span>{{ $category['label'] }}</span>
                                    <span class="text-xs font-normal text-zinc-400 tabular-nums group-aria-pressed:text-violet-600 dark:text-zinc-500 dark:group-aria-pressed:text-violet-400" data-feature-category-count="{{ $category['id'] }}" aria-hidden="true">{{ $categoryCount }}</span>
                                </button>
                            @endforeach
                        </div>
                        <div class="mt-7 border-t border-zinc-200 px-3 pt-6 dark:border-white/10">
                            <p class="text-xs leading-5 text-zinc-500 dark:text-zinc-400">Want to go deeper?</p>
                            <a href="{{ route('docs.index') }}" class="mt-1 inline-flex min-h-9 items-center gap-2 rounded-sm text-sm font-medium text-zinc-700 hover:text-violet-700 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-500 dark:text-zinc-300 dark:hover:text-violet-300">
                                Read the documentation
                                <span aria-hidden="true">↗</span>
                            </a>
                        </div>
                    </div>
                </aside>

                <div class="min-w-0 space-y-16 lg:space-y-20" id="feature-results">
                    <div class="py-12 sm:py-16" data-feature-empty hidden>
                        <svg class="mb-5 size-8 text-zinc-400 dark:text-zinc-500" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <circle cx="10.5" cy="10.5" r="6.5" stroke="currentColor" stroke-width="1.5"/>
                            <path d="m16 16 4.5 4.5M8 10.5h5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                        <h2 class="text-2xl font-semibold tracking-tight text-zinc-950 dark:text-white">No matching features</h2>
                        <p class="mt-3 max-w-md text-base leading-7 text-zinc-600 dark:text-zinc-400">Try a broader term, or reset the filters to explore the full catalogue.</p>
                        <button type="button" class="mt-6 inline-flex min-h-11 items-center rounded-lg bg-violet-700 px-5 text-sm font-medium text-white hover:bg-violet-800 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-500 dark:bg-violet-400 dark:text-violet-950 dark:hover:bg-violet-300" data-feature-reset>Reset filters</button>
                    </div>

                    @foreach ($collections as $collection)
                        <section data-feature-collection="{{ $collection['id'] }}" aria-labelledby="collection-{{ $collection['id'] }}">
                            <div class="flex items-start gap-4 border-b border-zinc-200 pb-6 dark:border-white/10">
                                <span class="pt-2 text-xs text-violet-600 tabular-nums dark:text-violet-400" aria-hidden="true">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                <div class="min-w-0">
                                    <h2 id="collection-{{ $collection['id'] }}" class="text-2xl font-semibold tracking-[-0.035em] text-zinc-950 sm:text-3xl dark:text-white">{{ $collection['label'] }}</h2>
                                    <p class="mt-2 max-w-xl text-sm leading-6 text-zinc-600 dark:text-zinc-400">{{ $collection['description'] }}</p>
                                </div>
                            </div>

                            <div class="space-y-10 pt-8 sm:space-y-12">
                                @foreach ($collection['sections'] as $section)
                                    <section
                                        class="scroll-mt-64 lg:scroll-mt-36"
                                        id="{{ $section['id'] }}"
                                        aria-labelledby="{{ $section['id'] }}-title"
                                        data-feature-section="{{ $section['id'] }}"
                                        data-feature-context="{{ $collection['label'].' '.$section['title'].' '.$section['description'] }}"
                                    >
                                        <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1">
                                            <h3 id="{{ $section['id'] }}-title" class="text-lg font-semibold tracking-[-0.02em] text-zinc-950 dark:text-white">{{ $section['title'] }}</h3>
                                            <a class="inline-flex min-h-9 items-center gap-1.5 rounded-sm text-xs font-medium text-violet-700 hover:text-violet-900 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-500 dark:text-violet-300 dark:hover:text-violet-200" href="{{ route($section['docs']) }}" aria-label="Read documentation for {{ $section['title'] }}">Read the docs <span aria-hidden="true">↗</span></a>
                                        </div>
                                        <p class="mt-1 max-w-2xl text-sm leading-6 text-zinc-600 dark:text-zinc-400">{{ $section['description'] }}</p>

                                        <ul class="mt-6 grid gap-x-9 gap-y-6 sm:grid-cols-2" role="list">
                                            @foreach ($section['features'] as $feature)
                                                <li class="min-w-0 border-l border-zinc-200 pl-4 dark:border-white/10" data-feature data-feature-search-text="{{ $feature['title'].' '.$feature['description'].' '.($feature['keywords'] ?? '') }}">
                                                    <h4 class="text-sm leading-6 font-semibold text-zinc-800 dark:text-zinc-200">{{ $feature['title'] }}</h4>
                                                    <p class="mt-1 text-sm leading-6 text-zinc-600 dark:text-zinc-400">{{ $feature['description'] }}</p>
                                                </li>
                                            @endforeach
                                        </ul>

                                        @if (! empty($section['note']))
                                            <p class="mt-5 text-xs leading-5 text-zinc-500 dark:text-zinc-400">{{ $section['note'] }}</p>
                                        @endif
                                    </section>
                                @endforeach
                            </div>
                        </section>
                    @endforeach
                </div>
            </div>
        </div>

        <section class="border-t border-zinc-200 bg-zinc-50/70 dark:border-white/10 dark:bg-white/[0.015]" aria-labelledby="features-start-title">
            <div class="mx-auto flex max-w-[76rem] flex-col gap-7 px-5 py-12 sm:px-8 lg:flex-row lg:items-center lg:justify-between lg:gap-12 lg:px-10 lg:py-16">
                <div>
                    <h2 id="features-start-title" class="text-2xl font-semibold tracking-[-0.035em] text-zinc-950 sm:text-3xl dark:text-white">See it in your own Laravel app.</h2>
                    <p class="mt-3 text-base leading-7 text-zinc-600 dark:text-zinc-400">Free and open source. Install locally and start with your next request.</p>
                </div>
                <a href="{{ route('docs.installation') }}" class="inline-flex min-h-12 shrink-0 items-center justify-center gap-3 self-start rounded-xl bg-violet-700 px-6 text-sm font-semibold text-white transition-colors hover:bg-violet-800 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-500 lg:self-auto dark:bg-violet-400 dark:text-violet-950 dark:hover:bg-violet-300">
                    Install the New Debug Bar
                    <span aria-hidden="true">→</span>
                </a>
            </div>
        </section>
    </main>
</x-layouts.site>
