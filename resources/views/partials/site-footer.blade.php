<footer class="bg-zinc-50 dark:bg-[#07070a]">
    <div class="mx-auto max-w-[100rem] px-5 py-8 sm:px-8 sm:py-10 lg:px-10">
        <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
            <a
                class="inline-flex w-fit flex-col rounded-lg focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-500"
                href="/"
                aria-label="New Debug Bar home"
            >
                <span class="text-base font-semibold tracking-[-0.035em] text-zinc-950 dark:text-white">New Debug Bar</span>
                <span class="mt-0.5 text-[0.625rem] font-semibold uppercase tracking-[0.18em] text-violet-600 dark:text-violet-400">for Laravel</span>
            </a>

            <nav aria-label="Footer navigation">
                <ul class="-mx-2 flex flex-wrap items-center gap-x-2 gap-y-1" role="list">
                    <li>
                        <a class="inline-flex min-h-10 items-center rounded-lg px-2 text-sm font-medium text-violet-700 transition-colors hover:bg-violet-600/[0.07] hover:text-violet-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:text-violet-300 dark:hover:bg-violet-400/10 dark:hover:text-violet-200" href="https://github.com/sponsors/benjamincrozat">Sponsor</a>
                    </li>
                    <li>
                        <a
                            class="inline-flex min-h-10 items-center rounded-lg px-2 text-sm font-medium text-zinc-600 transition-colors hover:bg-zinc-950/[0.04] hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 aria-[current=page]:text-violet-700 dark:text-zinc-400 dark:hover:bg-white/[0.06] dark:hover:text-white dark:aria-[current=page]:text-violet-300"
                            href="{{ route('features') }}"
                            @if (request()->routeIs('features')) aria-current="page" @endif
                        >Features</a>
                    </li>
                    <li>
                        <a class="inline-flex min-h-10 items-center rounded-lg px-2 text-sm font-medium text-zinc-600 transition-colors hover:bg-zinc-950/[0.04] hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:text-zinc-400 dark:hover:bg-white/[0.06] dark:hover:text-white" href="{{ route('docs.index') }}">Docs</a>
                    </li>
                    <li>
                        <a class="inline-flex min-h-10 items-center rounded-lg px-2 text-sm font-medium text-zinc-600 transition-colors hover:bg-zinc-950/[0.04] hover:text-zinc-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:text-zinc-400 dark:hover:bg-white/[0.06] dark:hover:text-white" href="https://github.com/newdebugbar/newdebugbar">GitHub</a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="mt-6 flex flex-col gap-3 border-t border-zinc-950/[0.07] pt-5 text-sm text-zinc-500 sm:flex-row sm:items-center sm:justify-between dark:border-white/[0.08] dark:text-zinc-500">
            <div>
                <p>Built by <span class="font-medium text-zinc-700 dark:text-zinc-300">Benjamin Crozat</span></p>
                <nav class="mt-1" aria-label="Benjamin Crozat links">
                    <ul class="flex flex-wrap items-center gap-x-4" role="list">
                        @foreach (['Blog' => 'https://benjamincrozat.com', 'GitHub' => 'https://github.com/benjamincrozat', 'X' => 'https://x.com/benjamincrozat'] as $label => $url)
                            <li>
                                <a class="inline-flex min-h-8 min-w-6 items-center font-medium text-zinc-700 underline decoration-zinc-300 underline-offset-4 transition-colors hover:text-zinc-950 focus-visible:rounded-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:text-zinc-300 dark:decoration-zinc-700 dark:hover:text-white" href="{{ $url }}">{{ $label }}</a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
            <p>
                Open source under the <a class="font-medium text-zinc-700 underline decoration-zinc-300 underline-offset-4 transition-colors hover:text-zinc-950 focus-visible:rounded-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500 dark:text-zinc-300 dark:decoration-zinc-700 dark:hover:text-white" href="https://github.com/newdebugbar/newdebugbar/blob/main/LICENSE">Apache License 2.0</a>.
            </p>
        </div>
    </div>
</footer>
