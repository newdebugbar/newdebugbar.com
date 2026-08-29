<li {{ $attributes->class('flex gap-3 text-base leading-7 text-zinc-700 dark:text-zinc-300') }}>
    <svg class="mt-1 size-5 shrink-0 text-violet-600 dark:text-violet-400" viewBox="0 0 20 20" fill="none" aria-hidden="true">
        <path d="m4.5 10.5 3.2 3.2 7.8-8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    <span class="min-w-0">{{ $slot }}</span>
</li>
