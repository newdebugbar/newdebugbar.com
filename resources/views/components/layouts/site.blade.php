@props([
    'title',
    'description',
    'scrollSmooth' => false,
    'canonical' => null,
    'ogType' => 'website',
    'ogTitle' => null,
    'ogDescription' => null,
    'socialImage' => null,
    'socialImageAlt' => 'New Debug Bar for Laravel with the Requests inspector open',
    'structuredData' => null,
])

@php
    $resolvedSocialImage = url($socialImage ?? Illuminate\Support\Facades\Vite::asset('resources/images/social/newdebugbar-og.png'));
@endphp

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

        @if ($canonical)
            <link rel="canonical" href="{{ $canonical }}">
        @endif

        <meta property="og:type" content="{{ $ogType }}">
        <meta property="og:site_name" content="New Debug Bar">
        <meta property="og:title" content="{{ $ogTitle ?? $title }}">
        <meta property="og:description" content="{{ $ogDescription ?? $description }}">
        @if ($canonical)
            <meta property="og:url" content="{{ $canonical }}">
        @endif
        <meta property="og:image" content="{{ $resolvedSocialImage }}">
        <meta property="og:image:type" content="image/png">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:image:alt" content="{{ $socialImageAlt }}">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $ogTitle ?? $title }}">
        <meta name="twitter:description" content="{{ $ogDescription ?? $description }}">
        <meta name="twitter:image" content="{{ $resolvedSocialImage }}">
        <meta name="twitter:image:alt" content="{{ $socialImageAlt }}">

        @if ($structuredData)
            <script type="application/ld+json">{!! json_encode($structuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}</script>
        @endif

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
