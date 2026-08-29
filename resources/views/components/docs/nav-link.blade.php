@props([
    'href',
    'active' => false,
])

<a
    {{ $attributes->class([
        'mt-3 flex min-h-10 items-center rounded-lg px-3 text-sm font-medium focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500',
        'bg-violet-50 text-violet-700 dark:bg-violet-400/10 dark:text-violet-300' => $active,
        'text-zinc-600 transition-colors hover:bg-zinc-100 hover:text-zinc-950 dark:text-zinc-400 dark:hover:bg-white/[0.06] dark:hover:text-white' => ! $active,
    ]) }}
    href="{{ $href }}"
    @if ($active) aria-current="page" @endif
>
    {{ $slot }}
</a>
