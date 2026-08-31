@props([
    'metaTitle',
    'description',
    'canonical',
    'ogTitle',
    'ogDescription',
    'pageTitle',
    'sections' => [],
])

@php
    $isDocsHome = request()->routeIs('docs.index');

    $breadcrumbItems = [
        [
            '@type' => 'ListItem',
            'position' => 1,
            'name' => 'Home',
            'item' => url('/'),
        ],
        [
            '@type' => 'ListItem',
            'position' => 2,
            'name' => 'Documentation',
            'item' => route('docs.index'),
        ],
    ];

    if (! $isDocsHome) {
        $breadcrumbItems[] = [
            '@type' => 'ListItem',
            'position' => 3,
            'name' => $pageTitle,
            'item' => $canonical,
        ];
    }

    $breadcrumbs = [
        '@type' => 'BreadcrumbList',
        'itemListElement' => $breadcrumbItems,
    ];

    $structuredData = [
        '@context' => 'https://schema.org',
        '@graph' => [
            $breadcrumbs,
            [
                '@type' => $isDocsHome ? 'CollectionPage' : 'TechArticle',
                'name' => $pageTitle,
                'headline' => $pageTitle,
                'description' => $description,
                'url' => $canonical,
                'isPartOf' => [
                    '@type' => 'WebSite',
                    'name' => 'New Debug Bar',
                    'url' => url('/'),
                ],
            ],
        ],
    ];
@endphp

<x-layouts.site
    :title="$metaTitle"
    :description="$description"
    :canonical="$canonical"
    og-type="article"
    :og-title="$ogTitle"
    :og-description="$ogDescription"
    :structured-data="$structuredData"
    :scroll-smooth="true"
>

    <main class="border-b border-zinc-950/[0.07] bg-white dark:border-white/[0.08] dark:bg-[#09090c]" data-docs-shell>
        <div class="mx-auto grid max-w-[76rem] lg:grid-cols-[14rem_minmax(0,1fr)] xl:grid-cols-[14rem_minmax(0,48rem)_14rem]">
            <aside class="hidden border-r border-zinc-950/[0.07] px-6 py-14 lg:block dark:border-white/[0.08]">
                <x-docs.navigation />
            </aside>

            <article class="min-w-0 px-5 py-8 sm:px-8 sm:py-12 lg:px-10 lg:py-14 xl:px-12 xl:py-16">
                <nav class="mb-6 flex items-center gap-2 text-sm text-zinc-500 lg:hidden dark:text-zinc-400" aria-label="Breadcrumb">
                    <a class="rounded-sm underline decoration-zinc-300 underline-offset-4 hover:text-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:decoration-zinc-700 dark:hover:text-zinc-200" href="{{ url('/') }}">Home</a>
                    <svg class="size-3.5" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                        <path d="m6 3.5 4 4.5-4 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    @if ($isDocsHome)
                        <span class="font-medium text-zinc-800 dark:text-zinc-200">Documentation</span>
                    @else
                        <a class="rounded-sm underline decoration-zinc-300 underline-offset-4 hover:text-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:decoration-zinc-700 dark:hover:text-zinc-200" href="{{ route('docs.index') }}">Docs</a>
                        <svg class="size-3.5" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                            <path d="m6 3.5 4 4.5-4 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="truncate font-medium text-zinc-800 dark:text-zinc-200">{{ $pageTitle }}</span>
                    @endif
                </nav>

                {{ $slot }}
            </article>

            <aside class="hidden border-l border-zinc-950/[0.07] px-6 py-16 xl:block dark:border-white/[0.08]" @if ($sections !== []) aria-label="On this page" @else aria-hidden="true" @endif>
                @if ($sections !== [])
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
                @endif
            </aside>
        </div>
    </main>
</x-layouts.site>
