<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />

        <title>{{ $title ?? config('app.name') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900" />
    </head>
    <body {{ $attributes->class('bg-gray-900 font-light text-gray-300') }}>
        {{ $slot }}

        @session('notification')
            <x-notification type="{{ $value['type'] }}">
                {{ $value['message'] }}
            </x-notification>
        @endsession
    </body>
</html>
