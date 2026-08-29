@props([
    'code',
    'copyLabel' => 'Copy code',
    'copySuccess' => 'Code copied',
    'prompt' => false,
    'prominent' => false,
])

<div
    {{ $attributes->class([
        'overflow-hidden rounded-2xl border border-zinc-800 bg-[#111116] dark:border-white/10',
        'shadow-lg shadow-zinc-950/10 dark:shadow-black/25' => $prominent,
    ]) }}
    data-copy-root
    data-docs-code-block
>
    <div class="flex min-w-0 items-center gap-4 px-4 py-4 sm:px-5">
        @if ($prompt)
            <span class="shrink-0 font-mono text-sm text-violet-400" aria-hidden="true">$</span>
        @endif
        <code class="min-w-0 flex-1 overflow-x-auto whitespace-nowrap font-mono text-sm leading-6 text-zinc-100 sm:text-[0.9375rem]">{{ $code }}</code>
        <button
            class="relative grid size-6 shrink-0 place-items-center text-zinc-400 transition-colors after:absolute after:-inset-2.5 after:content-[''] hover:text-white focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-400"
            type="button"
            data-copy-command="{{ $code }}"
            data-copy-label="{{ $copyLabel }}"
            data-copy-success="{{ $copySuccess }}"
            aria-label="{{ $copyLabel }}"
            title="{{ $copyLabel }}"
        >
            <svg data-copy-icon class="size-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <rect x="8" y="8" width="11" height="11" rx="2" stroke="currentColor" stroke-width="1.7"/>
                <path d="M16 8V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
            </svg>
            <svg data-copy-success class="hidden size-5 text-emerald-400" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="m5 12.5 4.3 4.3L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
        <p class="sr-only" data-copy-status aria-live="polite"></p>
    </div>
</div>
