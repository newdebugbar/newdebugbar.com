@props([
    'alt',
    'loading' => null,
    'fetchpriority' => null,
])

<picture {{ $attributes->class('block aspect-[1536/780] max-[47.999rem]:aspect-[804/1432]') }} data-request-inspector-screenshot>
    <source media="(max-width: 47.999rem)" data-request-inspector-mobile-source>
    <img
        class="block h-auto w-full drop-shadow-[0_1.75rem_2.5rem_rgb(24_10_58_/_17%)] dark:drop-shadow-[0_1.75rem_2.5rem_rgb(0_0_0_/_48%)]"
        data-request-inspector-image
        width="1536"
        height="780"
        alt="{{ $alt }}"
        decoding="async"
        @if ($loading) loading="{{ $loading }}" @endif
        @if ($fetchpriority) fetchpriority="{{ $fetchpriority }}" @endif
    >
</picture>
