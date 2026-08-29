@props([
    'number',
    'title',
])

<li {{ $attributes->class('flex gap-4') }}>
    <span class="grid size-8 shrink-0 place-items-center rounded-full bg-violet-100 text-sm font-semibold text-violet-700 dark:bg-violet-400/10 dark:text-violet-300" aria-hidden="true">
        {{ $number }}
    </span>
    <div class="min-w-0 pt-0.5">
        <h3 class="font-semibold text-zinc-950 dark:text-white">{{ $title }}</h3>
        <div class="mt-1 text-sm leading-6 text-zinc-600 dark:text-zinc-400">
            {{ $slot }}
        </div>
    </div>
</li>
