@php($groups = config('docs.navigation'))

<x-layouts.docs
    meta-title="The New Debug Bar documentation for Laravel"
    description="Learn how to install The New Debug Bar, inspect Laravel requests, debug queries and framework activity, connect coding agents, and test saved profiles."
    :canonical="url('/docs')"
    og-title="The New Debug Bar documentation"
    og-description="Practical guides for debugging Laravel requests, queries, performance, Livewire, queues, mail, cache, and more."
    page-title="Documentation"
>
    <x-docs.page-header category="The New Debug Bar" title="Debug Laravel with exact request data">
        Start with a request, follow the evidence to the code that produced it, and give local coding agents the same
        captured context.
    </x-docs.page-header>

    <x-docs.flow
        :steps="[
            ['title' => 'Capture a request', 'description' => 'Install the package, repeat the action, and select its exact profile.'],
            ['title' => 'Follow the evidence', 'description' => 'Use the inspector or your coding agent to trace a finding to its source.'],
            ['title' => 'Verify the change', 'description' => 'Repeat the same action and compare its data, behavior, and measurements.'],
        ]"
        caption="Use the guides below at the point where you need help: setup, diagnosis, or verification."
    />

    <div class="mt-14 space-y-16">
        @foreach ($groups as $group)
            <section aria-labelledby="{{ Illuminate\Support\Str::slug($group['label']) }}-title">
                <h2
                    id="{{ Illuminate\Support\Str::slug($group['label']) }}-title"
                    class="text-2xl font-semibold tracking-[-0.035em] text-zinc-950 dark:text-white"
                >
                    {{ $group['label'] }}
                </h2>

                <div class="mt-6 grid gap-4 sm:grid-cols-2">
                    @foreach ($group['pages'] as $page)
                        <x-docs.topic-card
                            :href="route($page['route'])"
                            :title="$page['label']"
                            :description="$page['description']"
                        />
                    @endforeach
                </div>
            </section>
        @endforeach
    </div>
</x-layouts.docs>
