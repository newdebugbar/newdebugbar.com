@props([
    'tone' => 'neutral',
    'title' => null,
    'label' => null,
])

@php
    $containerClasses = match ($tone) {
        'notice' => 'flex gap-4 rounded-2xl border border-violet-200 bg-violet-50/70 p-5 dark:border-violet-400/20 dark:bg-violet-400/[0.08]',
        'success' => 'flex gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-950 dark:border-emerald-400/20 dark:bg-emerald-400/[0.08] dark:text-emerald-100',
        default => 'rounded-xl border border-zinc-200 bg-zinc-50 p-4 text-zinc-600 dark:border-white/10 dark:bg-white/[0.035] dark:text-zinc-400',
    };

    $titleClasses = match ($tone) {
        'notice' => 'font-semibold text-violet-950 dark:text-violet-100',
        'success' => 'font-semibold',
        default => 'font-semibold text-zinc-900 dark:text-zinc-100',
    };

    $bodyClasses = match ($tone) {
        'notice' => 'text-sm leading-6 text-violet-900/75 dark:text-violet-200/75',
        default => 'text-sm leading-6',
    };
@endphp

<aside
    {{ $attributes->class($containerClasses) }}
    @if ($label || $title) aria-label="{{ $label ?? $title }}" @endif
>
    @if ($tone === 'notice')
        <svg class="mt-0.5 size-5 shrink-0 text-violet-600 dark:text-violet-300" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M12 3.5 21 20H3L12 3.5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
            <path d="M12 9v4.5M12 17h.01" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
        </svg>
    @elseif ($tone === 'success')
        <svg class="mt-0.5 size-5 shrink-0 text-emerald-600 dark:text-emerald-400" viewBox="0 0 20 20" fill="none" aria-hidden="true">
            <path d="m4.5 10.5 3.2 3.2 7.8-8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    @endif

    <div class="min-w-0">
        @if ($title)
            <p class="{{ $titleClasses }}">{{ $title }}</p>
        @endif
        <div @class([$bodyClasses, 'mt-1' => $title])>
            {{ $slot }}
        </div>
    </div>
</aside>
