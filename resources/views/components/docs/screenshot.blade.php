@props(['name', 'alt', 'caption'])

@php($directory = 'resources/images/screenshots/docs/'.$name)

<x-docs.figure {{ $attributes->class('mt-8') }} :caption="$caption">
    @foreach (['light', 'dark'] as $theme)
        <a
            @class(['block' => $theme === 'light', 'dark:hidden' => $theme === 'light', 'hidden dark:block' => $theme === 'dark'])
            href="{{ Vite::asset($directory.'-desktop-'.$theme.'.png') }}"
            target="_blank"
            rel="noopener"
            aria-label="Open full-size desktop screenshot: {{ $alt }}"
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
            <span class="mt-3 inline-flex text-xs font-medium text-violet-700 underline underline-offset-4 dark:text-violet-300">Open full-size desktop screenshot</span>
        </a>
    @endforeach
</x-docs.figure>
