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
            <header>
                <a href="https://github.com/sponsors/benjamincrozat" target="_blank">
                    <div class="bg-gray-950/50">
                        <div class="container py-4 text-sm text-center">
                            <strong class="font-medium text-white">Get early access. Help fund the project.</strong> <x-heroicon-s-arrow-top-right-on-square class="size-4 oopacity-75 ml-[.175rem] inline translate-y-[-2px]" />
                        </div>
                    </div>
                </a>

                <nav class="container flex items-center justify-between mt-4 2xl:max-w-screen-xl">
                    <a wire:navigate href="{{ route('home') }}">
                        <x-icon-logo-h class="hidden h-10 md:block" />
                        <x-icon-icon class="h-8 sm:h-10 md:hidden" />
                        <span class="sr-only">Home</span>
                    </a>

                    <x-nav />
                </nav>
            </header>

            <main class="flex-grow">
                {{ $slot }}
            </main>

            <x-footer class="mt-8 md:mt-16" />
        </div>

        <x-notifications />

        <livewire:scripts />
    </body>
</html>
