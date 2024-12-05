<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />

        <title>{{ $title ?? config('app.name') }}</title>

        @if (app()->isProduction())
            <script defer src="https://api.pirsch.io/pa.js" id="pianjs" data-code="HXdkUoyfzOakKngFs6IwJUaR7WryTzx3"></script>
        @endif

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900" />

        <link rel="icon" type="image/png" href="{{ Vite::asset('resources/img/favicon-96x96.png') }}" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="{{ Vite::asset('resources/img/favicon.svg') }}" />
        <link rel="shortcut icon" href="{{ Vite::asset('resources/img/favicon.ico') }}" />
        <link rel="apple-touch-icon" sizes="180x180" href="{{ Vite::asset('resources/img/apple-touch-icon.png') }}" />
    </head>
    <body {{ $attributes->class('bg-gray-900 font-light text-gray-300') }}>
        <a href="https://github.com/sponsors/benjamincrozat" target="_blank">
            <div class="bg-gray-950">
                <div class="container text-center py-4 text-sm">
                    <strong class="font-medium text-white">Get early access. Help fund the project.</strong> <x-heroicon-s-arrow-top-right-on-square class="size-4 oopacity-75 ml-[.175rem] inline translate-y-[-2px]" />
                </div>
            </div>
        </a>

        {{ $slot }}

        <x-notifications />
    </body>
</html>
