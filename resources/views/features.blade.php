{{-- The complete feature reference for the New Debug Bar. --}}
<x-layouts.site
    title="Everything the New Debug Bar can do"
    description="Features of the New Debug Bar for Laravel, including SQL queries, Livewire components, requests, cache, queues, mail, and local MCP tools."
    :canonical="route('features')"
>
    <main class="border-b border-zinc-200 bg-white dark:border-white/10 dark:bg-[#09090c]" id="features">
        <div class="mx-auto max-w-5xl px-5 pt-10 pb-16 sm:px-8 sm:pt-12 lg:px-10 lg:pt-14 lg:pb-24">
            <h1 class="text-4xl leading-tight font-semibold tracking-[-0.045em] text-zinc-950 sm:text-5xl dark:text-white">
                Everything the New Debug Bar can do
            </h1>

            <div class="mt-12 space-y-16 lg:mt-16 lg:space-y-20">
                @foreach (config('features', []) as $collection)
                    <section aria-labelledby="collection-{{ $collection['id'] }}">
                        <div class="flex items-start gap-4 border-b border-zinc-200 pb-6 dark:border-white/10">
                            <span class="flex size-8 shrink-0 items-center justify-center rounded-full border border-violet-200 bg-violet-50 font-mono text-xs font-medium leading-none tabular-nums text-violet-700 dark:border-white/15 dark:bg-white/5 dark:text-violet-300" aria-hidden="true">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <div class="min-w-0">
                                <h2 id="collection-{{ $collection['id'] }}" class="text-2xl font-semibold tracking-[-0.035em] text-zinc-950 sm:text-3xl dark:text-white">{{ $collection['label'] }}</h2>
                                <p class="mt-2 max-w-xl text-sm leading-6 text-zinc-600 dark:text-zinc-400">{{ $collection['description'] }}</p>
                            </div>
                        </div>

                        <div class="space-y-10 pt-8 sm:space-y-12">
                            @foreach ($collection['sections'] as $section)
                                <section
                                    class="scroll-mt-8"
                                    id="{{ $section['id'] }}"
                                    aria-labelledby="{{ $section['id'] }}-title"
                                >
                                    <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1">
                                        <h3 id="{{ $section['id'] }}-title" class="text-lg font-semibold tracking-[-0.02em] text-zinc-950 dark:text-white">{{ $section['title'] }}</h3>
                                        <a class="inline-flex min-h-9 items-center gap-1.5 rounded-sm text-xs font-medium text-violet-700 hover:text-violet-900 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-500 dark:text-violet-300 dark:hover:text-violet-200" href="{{ route($section['docs']) }}" aria-label="Read documentation for {{ $section['title'] }}">Read the docs <span aria-hidden="true">↗</span></a>
                                    </div>
                                    <p class="mt-1 max-w-2xl text-sm leading-6 text-zinc-600 dark:text-zinc-400">{{ $section['description'] }}</p>

                                    <ul class="mt-6 grid gap-x-9 gap-y-6 sm:grid-cols-2" role="list">
                                        @foreach ($section['features'] as $feature)
                                            <li class="min-w-0 border-l border-zinc-200 pl-4 dark:border-white/10">
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
    </main>
</x-layouts.site>
