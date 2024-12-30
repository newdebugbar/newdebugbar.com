<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="scroll-smooth">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />

        <title>{{ $title ?? config('app.name') }}</title>

        <meta property="og:image" content="{{ Vite::asset('resources/img/og-image.webp') }}" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:image" content="{{ Vite::asset('resources/img/og-image.webp') }}" />

        <livewire:styles />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @if (app()->isProduction())
            <script defer src="https://api.pirsch.io/pa.js" id="pianjs" data-code="HXdkUoyfzOakKngFs6IwJUaR7WryTzx3"></script>
        @endif

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" />

        <link rel="icon" type="image/png" href="{{ Vite::asset('resources/img/favicon-96x96.png') }}" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="{{ Vite::asset('resources/img/favicon.svg') }}" />
        <link rel="shortcut icon" href="{{ Vite::asset('resources/img/favicon.ico') }}" />
        <link rel="apple-touch-icon" sizes="180x180" href="{{ Vite::asset('resources/img/apple-touch-icon.png') }}" />
    </head>
    <body {{ $attributes->class('bg-gray-900 font-light text-gray-300') }}>
        <div class="flex flex-col min-h-screen">
            <a href="https://github.com/sponsors/benjamincrozat" target="_blank">
                <div class="bg-gray-950">
                    <div class="container py-4 text-sm text-center">
                        <strong class="font-medium text-white">Get early access. Help fund the project.</strong> <x-heroicon-s-arrow-top-right-on-square class="size-4 oopacity-75 ml-[.175rem] inline translate-y-[-2px]" />
                    </div>
                </div>
            </a>

            <nav class="container flex items-center justify-end gap-8 mt-8 text-sm md:text-base xl:max-w-screen-lg">
                <a href="#roadmap" data-pirsch-event='Clicked "Roadmap" in the nav bar' class="font-medium">Roadmap</a>

                <a href="#sponsors" data-pirsch-event='Clicked "Sponsors" in the nav bar' class="font-medium">Sponsors</a>

                <a href="https://github.com/newdebugbar" target="_blank" data-pirsch-event="Clicked GitHub in the nav bar" class="fill-current">
                    <x-icon-github class="size-4 md:size-5" />
                </a>

                <a href="https://x.com/newdebugbar" target="_blank" data-pirsch-event="Clicked X in the nav bar" class="-ml-4 fill-current">
                    <x-icon-x class="size-4 md:size-5" />
                </a>
            </nav>

            <div class="flex-grow">
                {{ $slot }}
            </div>

            <footer class="py-8 mt-16 text-center bg-gray-950">
                <nav class="container flex items-center justify-center gap-4 xl:max-w-screen-lg">
                    <a href="https://github.com/newdebugbar" target="_blank" data-pirsch-event="Clicked GitHub in the footer" class="inline-block">
                        <x-icon-github class="fill-current size-5" />
                    </a>

                    <a href="https://x.com/newdebugbar" target="_blank" data-pirsch-event="Clicked X in the footer" class="inline-block">
                        <x-icon-x class="fill-current size-5" />
                    </a>
                </nav>

                <p class="mt-4 text-sm text-gray-500">
                    Made with <span class="text-pink-400">♥</span> by <a href="https://x.com/benjamincrozat" target="_blank" data-pirsch-event="Clicked Benjamin's name" class="font-medium text-gray-400 underline underline-offset-4 decoration-gray-400/50">Benjamin Crozat</a>.
                </p>
            </footer>
        </div>

        <x-notifications />

        <livewire:scripts />
    </body>
</html>
