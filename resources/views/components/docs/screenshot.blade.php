@props(['name', 'alt', 'caption'])

@php($directory = 'resources/images/screenshots/docs/'.$name)

<x-docs.figure {{ $attributes->class('mt-8') }} :caption="$caption">
    @foreach (['light', 'dark'] as $theme)
        <a
            @class([
                'cursor-zoom-in focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-500',
                'block dark:hidden' => $theme === 'light',
                'hidden dark:block' => $theme === 'dark',
            ])
            href="{{ Vite::asset($directory.'-desktop-'.$theme.'.png') }}"
            target="_blank"
            rel="noopener"
            data-docs-screenshot="{{ $name }}"
            data-docs-screenshot-theme="{{ $theme }}"
        >
            <picture class="block aspect-[1536/780] max-[47.999rem]:aspect-[804/1434]">
                <source
                    media="(max-width: 47.999rem)"
                    srcset="{{ Vite::asset($directory.'-mobile-'.$theme.'.png') }}"
                    width="804"
                    height="1434"
                >
                <img
                    class="block h-auto w-full"
                    src="{{ Vite::asset($directory.'-desktop-'.$theme.'.png') }}"
                    width="3072"
                    height="1560"
                    alt="{{ $alt }}"
                    loading="lazy"
                    decoding="async"
                >
            </picture>
        </a>
    @endforeach
</x-docs.figure>
