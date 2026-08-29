@props(['summary'])

<details {{ $attributes->class('group py-1') }}>
    <summary class="flex min-h-14 cursor-pointer list-none items-center gap-4 rounded-lg py-3 font-medium text-zinc-900 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:text-zinc-100 [&::-webkit-details-marker]:hidden">
        {{ $summary }}
        <svg class="ml-auto size-4 shrink-0 text-zinc-400 transition-transform group-open:rotate-45" viewBox="0 0 16 16" fill="none" aria-hidden="true">
            <path d="M8 3v10M3 8h10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
    </summary>
    <div class="pb-5 pr-8 text-sm leading-6 text-zinc-600 dark:text-zinc-400">
        {{ $slot }}
    </div>
</details>
