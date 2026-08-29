@props([
    'id' => 'next',
    'href',
    'title',
    'description',
    'linkLabel',
])

<section {{ $attributes->class('pt-14') }} aria-labelledby="{{ $id }}-title">
    <a
        class="group block rounded-2xl border border-violet-200 bg-gradient-to-br from-violet-50 to-white p-6 transition-colors hover:border-violet-300 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-500 sm:p-7 dark:border-violet-400/20 dark:from-violet-400/[0.1] dark:to-white/[0.025] dark:hover:border-violet-400/35"
        href="{{ $href }}"
    >
        <div class="flex items-start gap-5">
            @isset($icon)
                <div class="grid size-11 shrink-0 place-items-center rounded-xl bg-violet-600 text-white shadow-lg shadow-violet-600/20 dark:bg-violet-500">
                    {{ $icon }}
                </div>
            @endisset
            <div class="min-w-0">
                <p class="text-sm font-semibold text-violet-700 dark:text-violet-300">Next step</p>
                <h2 id="{{ $id }}-title" class="mt-1 text-xl font-semibold tracking-[-0.025em] text-zinc-950 dark:text-white">{{ $title }}</h2>
                <p class="mt-2 text-sm leading-6 text-zinc-600 dark:text-zinc-400">{{ $description }}</p>
                <span class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-violet-700 dark:text-violet-300">
                    {{ $linkLabel }}
                    <svg class="size-4 transition-transform group-hover:translate-x-0.5" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                        <path d="M3 8h9M8.5 4.5 12 8l-3.5 3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </div>
        </div>
    </a>
</section>
