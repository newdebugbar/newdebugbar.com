@props([
    'points',
])

<ul {{ $attributes->class('mt-4 space-y-2.5 text-sm leading-6 text-zinc-700 dark:text-zinc-300') }}>
    @foreach ($points as $point)
        <li class="flex gap-3">
            <span class="mt-[0.65rem] size-1.5 shrink-0 rounded-full bg-violet-600 dark:bg-violet-400" aria-hidden="true"></span>
            <span>{{ $point }}</span>
        </li>
    @endforeach
</ul>
