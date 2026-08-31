@props([
    'points',
    'compact' => false,
])

@php
    $listClasses = $compact
        ? 'mt-3 space-y-2 text-sm leading-5 text-zinc-700 dark:text-zinc-300'
        : 'mt-4 space-y-2.5 text-sm leading-6 text-zinc-700 dark:text-zinc-300';
    $itemClasses = $compact ? 'flex gap-2.5' : 'flex gap-3';
    $markerClasses = $compact
        ? 'mt-2 size-1.5 shrink-0 rounded-full bg-violet-600 dark:bg-violet-400'
        : 'mt-[0.65rem] size-1.5 shrink-0 rounded-full bg-violet-600 dark:bg-violet-400';
@endphp

<ul {{ $attributes->class($listClasses) }}>
    @foreach ($points as $point)
        <li class="{{ $itemClasses }}">
            <span class="{{ $markerClasses }}" aria-hidden="true"></span>
            <span>{{ $point }}</span>
        </li>
    @endforeach
</ul>
