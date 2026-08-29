@props([
    'metaTitle',
    'description',
    'canonical',
    'ogTitle',
    'ogDescription',
    'pageTitle',
    'sections' => [],
])

<x-layouts.site :title="$metaTitle" :description="$description" :scroll-smooth="true">
    <x-slot:head>
        <link rel="canonical" href="{{ $canonical }}">

        <meta property="og:type" content="article">
        <meta property="og:title" content="{{ $ogTitle }}">
        <meta property="og:description" content="{{ $ogDescription }}">
        <meta property="og:url" content="{{ $canonical }}">
    </x-slot:head>

    <main class="border-b border-zinc-950/[0.07] bg-white dark:border-white/[0.08] dark:bg-[#09090c]" data-docs-shell>
        <div class="mx-auto grid max-w-[100rem] lg:grid-cols-[14rem_minmax(0,1fr)] xl:grid-cols-[14rem_minmax(0,48rem)_13rem]">
            <aside class="hidden border-r border-zinc-950/[0.07] px-8 py-14 lg:block dark:border-white/[0.08]" aria-label="Documentation navigation">
                <nav class="sticky top-8">
                    <p class="text-sm font-semibold text-zinc-950 dark:text-white">Documentation</p>

                    <div class="mt-7">
                        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-zinc-400 dark:text-zinc-500">Getting started</p>
                        <x-docs.nav-link :href="route('docs.installation')" :active="request()->routeIs('docs.installation')">
                            Installation
                        </x-docs.nav-link>
                    </div>

                    <div class="mt-8 border-t border-zinc-950/[0.07] pt-7 dark:border-white/[0.08]">
                        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-zinc-400 dark:text-zinc-500">Use with agents</p>
                        <x-docs.nav-link :href="route('docs.mcp')" :active="request()->routeIs('docs.mcp')">
                            MCP setup
                        </x-docs.nav-link>
                    </div>
                </nav>
            </aside>

            <article class="min-w-0 px-5 py-10 sm:px-8 sm:py-14 lg:px-10 xl:px-12 xl:py-16">
                <nav class="mb-8 flex items-center gap-2 text-sm text-zinc-500 lg:hidden dark:text-zinc-400" aria-label="Breadcrumb">
                    <span>Docs</span>
                    <svg class="size-3.5" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                        <path d="m6 3.5 4 4.5-4 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="font-medium text-zinc-800 dark:text-zinc-200">{{ $pageTitle }}</span>
                </nav>

                {{ $slot }}
            </article>

            <aside class="hidden border-l border-zinc-950/[0.07] px-6 py-16 xl:block dark:border-white/[0.08]" aria-label="On this page">
                <nav class="sticky top-8">
                    <p class="text-xs font-semibold uppercase tracking-[0.16em] text-zinc-400 dark:text-zinc-500">On this page</p>
                    <ul class="mt-4 space-y-1 text-sm" role="list">
                        @foreach ($sections as $section)
                            <li>
                                <a class="flex min-h-9 items-center rounded-lg px-2 text-zinc-600 transition-colors hover:bg-zinc-100 hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:text-zinc-400 dark:hover:bg-white/[0.06] dark:hover:text-white" href="#{{ $section['id'] }}">
                                    {{ $section['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </aside>
        </div>
    </main>
</x-layouts.site>
