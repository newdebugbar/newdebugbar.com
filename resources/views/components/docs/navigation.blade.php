@props([
    'compact' => false,
])

@php($groups = config('docs.navigation'))

<nav {{ $attributes }} aria-label="Documentation navigation">
    @foreach ($groups as $group)
        <section @class(['mt-6' => $loop->first && $compact, 'mt-7 border-t border-zinc-950/[0.07] pt-6 dark:border-white/[0.08]' => ! $loop->first])>
            <h2 class="text-xs font-semibold uppercase tracking-[0.16em] text-zinc-400 dark:text-zinc-500">
                {{ $group['label'] }}
            </h2>

            <div @class(['mt-3 space-y-1', 'grid gap-x-3 space-y-0 sm:grid-cols-2' => $compact])>
                @foreach ($group['pages'] as $page)
                    <x-docs.nav-link
                        :href="route($page['route'])"
                        :active="request()->routeIs($page['route'])"
                    >
                        {{ $page['label'] }}
                    </x-docs.nav-link>
                @endforeach
            </div>
        </section>
    @endforeach
</nav>
