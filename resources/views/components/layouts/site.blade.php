@props([
    'title',
    'description',
    'scrollSmooth' => false,
])

<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    @class([
        'bg-[#fafafa] [color-scheme:light] dark:bg-[#07070a] dark:[color-scheme:dark]',
        'scroll-smooth' => $scrollSmooth,
    ])
    data-theme="dark"
    data-theme-mode="system"
>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ $description }}">
        <meta name="color-scheme" content="dark light">
        <meta name="theme-color" content="#07070a">

        {{ $head ?? '' }}

        <title>{{ $title }}</title>

        <script>
            const storedTheme = localStorage.getItem('newdebugbar-website-theme');
            const themeMode = ['system', 'light', 'dark'].includes(storedTheme) ? storedTheme : 'system';
            const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';

            document.documentElement.dataset.themeMode = themeMode;
            document.documentElement.dataset.theme = themeMode === 'system' ? systemTheme : themeMode;
        </script>

        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-zinc-50 text-zinc-950 antialiased transition-colors duration-300 [&_a]:[-webkit-tap-highlight-color:transparent] [&_button]:[-webkit-tap-highlight-color:transparent] dark:bg-[#07070a] dark:text-white">
        @include('partials.site-header')

        {{ $slot }}

        @include('partials.site-footer')
    </body>
</html>
