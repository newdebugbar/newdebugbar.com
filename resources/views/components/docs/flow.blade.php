@props(['steps', 'caption'])

<x-docs.figure {{ $attributes->class('mt-8') }} :caption="$caption">
    <ol class="grid gap-4 sm:grid-cols-3" data-docs-diagram>
        @foreach ($steps as $step)
            <li class="relative min-w-0 rounded-xl border border-violet-200/80 bg-violet-50/60 p-5 dark:border-violet-400/20 dark:bg-violet-400/[0.05]">
                <span class="mb-4 grid size-8 place-items-center rounded-full bg-violet-600 text-sm font-semibold text-white" aria-hidden="true">{{ $loop->iteration }}</span>
                <p class="text-sm font-semibold text-zinc-950 dark:text-white">{{ $step['title'] }}</p>
                <p class="mt-2 text-sm leading-6 text-zinc-600 dark:text-zinc-400">{{ $step['description'] }}</p>
                @unless ($loop->last)
                    <svg class="absolute -bottom-3 left-7 z-10 size-5 rotate-90 text-violet-500 sm:-right-3 sm:bottom-auto sm:left-auto sm:top-7 sm:rotate-0" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                        <path d="M3 10h13m-5-5 5 5-5 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                @endunless
            </li>
        @endforeach
    </ol>
</x-docs.figure>
