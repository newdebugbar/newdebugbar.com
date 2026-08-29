@props([
    'id',
    'title',
])

<section id="{{ $id }}" {{ $attributes->class('scroll-mt-8 pt-14') }} aria-labelledby="{{ $id }}-title">
    <h2 id="{{ $id }}-title" class="text-2xl font-semibold tracking-[-0.035em] text-zinc-950 dark:text-white">{{ $title }}</h2>

    {{ $slot }}
</section>
