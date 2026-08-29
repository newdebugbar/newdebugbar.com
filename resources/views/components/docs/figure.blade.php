@props(['caption'])

<figure {{ $attributes }} data-docs-figure>
    {{ $slot }}
    <figcaption class="mt-3 text-sm leading-6 text-zinc-500 dark:text-zinc-500">{{ $caption }}</figcaption>
</figure>
