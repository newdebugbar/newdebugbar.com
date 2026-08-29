@props([
    'href',
    'title',
    'description',
])

<a
    {{ $attributes->class('group flex min-h-40 flex-col rounded-2xl border border-zinc-200 bg-white p-5 transition-colors hover:border-violet-300 hover:bg-violet-50/40 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-500 dark:border-white/10 dark:bg-white/[0.025] dark:hover:border-violet-400/30 dark:hover:bg-violet-400/[0.06]') }}
    href="{{ $href }}"
>
    <h3 class="text-lg font-semibold tracking-[-0.025em] text-zinc-950 dark:text-white">{{ $title }}</h3>
    <p class="mt-2 text-sm leading-6 text-zinc-600 dark:text-zinc-400">{{ $description }}</p>
    <span class="mt-auto inline-flex items-center gap-2 pt-5 text-sm font-semibold text-violet-700 dark:text-violet-300">
        Read the guide
        <svg class="size-4 transition-transform group-hover:translate-x-0.5" viewBox="0 0 16 16" fill="none" aria-hidden="true">
            <path d="M3 8h9M8.5 4.5 12 8l-3.5 3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </span>
</a>
