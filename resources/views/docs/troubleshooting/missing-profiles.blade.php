@php
    $diagram1 = [['title' => 'Choose the profile', 'description' => 'Match the response ID, method, path, and time.'], ['title' => 'Check retained evidence', 'description' => 'Confirm the inspector exists and whether capture reported omissions.'], ['title' => 'Read the next part', 'description' => 'Follow MCP paths and cursors for values that are still stored.']];

    $example2 = <<<'EXAMPLE2'
{
  "path": "/trips/kyoto-autumn",
  "limit": 10
}
EXAMPLE2;

@endphp

<x-layouts.docs
    meta-title="Find missing profiles and data | The New Debug Bar"
    description="Find a missing Laravel request profile and distinguish retention, current-page discovery, capture limits, MCP pagination, and live-only evidence."
    :canonical="url('/docs/troubleshooting/missing-profiles')"
    og-title="Find missing profiles and data"
    og-description="Find a missing Laravel request profile and distinguish retention, current-page discovery, capture limits, MCP pagination, and live-only evidence."
    page-title="Missing profiles and data"
    :sections="[
        ['id' => 'identity', 'label' => 'Find the request you actually made'],
        ['id' => 'retention', 'label' => 'Check expiry and the shared directory'],
        ['id' => 'empty', 'label' => 'Can an empty inspector be correct?'],
        ['id' => 'limits', 'label' => 'Which limit did you reach?'],
        ['id' => 'live', 'label' => 'Was the evidence only available in the live browser?'],
        ['id' => 'verify', 'label' => 'Repeat and compare one known fact'],
    ]"
>
    <x-docs.page-header category="Troubleshooting" title="Find missing profiles and data">
        First locate the right profile. Then decide whether the missing evidence was never captured, has expired, or needs another bounded read.
    </x-docs.page-header>

    <x-docs.flow :steps="$diagram1" caption="Pagination can reveal retained data. It cannot recover values that were never stored." />

    <x-docs.section id="identity" title="Find the request you actually made">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Use the <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">X-NewDebugBar-Profile</code> response header when available. A later poll, fetch, or Livewire update may be newer than the page you meant to inspect.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The browser picker discovers requests on the current page. It is not a global browser for every retained API, command, or worker profile. Use <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">list-debug-profiles</code> through <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.mcp') }}">MCP</a> for retained profiles outside that list.</p>

        <x-docs.copyable-code class="mt-5" :code="$example2" copy-label="Copy profile-list arguments" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The example is the argument object for <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">list-debug-profiles</code>. Match the returned request facts before opening an ID.</p>
    </x-docs.section>

    <x-docs.section id="retention" title="Check expiry and the shared directory">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The default store keeps the latest 20 profiles and expires profiles after 60 minutes. A busy page or worker can fill that short history quickly. Changing retention later cannot restore a deleted profile.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">If the profile should still exist, compare <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">newdebugbar.storage.path</code> in the browser and MCP runtimes. A custom path must point to the same accessible files. Reproduce the action after correcting the path or retention setting.</p>
    </x-docs.section>

    <x-docs.section id="empty" title="Can an empty inspector be correct?">
        <ul class="mt-5 space-y-3" role="list">
            <x-docs.check-item>No mail was sent in this profile; a worker may have sent it later.</x-docs.check-item>
            <x-docs.check-item>A Redis-backed Laravel cache operation appears under Cache and is not duplicated under Redis.</x-docs.check-item>
            <x-docs.check-item>The request failed before the operation you expected to run.</x-docs.check-item>
            <x-docs.check-item>A library did not emit the Laravel events that this collector observes.</x-docs.check-item>
            <x-docs.check-item>An event retained payload shape or a view retained a lazy value’s class, rather than evaluating arbitrary application code.</x-docs.check-item>
        </ul>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">For queued work, open the correlated worker profile described in <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.queues') }}">Queues</a>.</p>
    </x-docs.section>

    <x-docs.section id="limits" title="Which limit did you reach?">
        <div class="mt-6 overflow-x-auto rounded-xl border border-zinc-200 dark:border-white/10">
            <table class="w-full min-w-[34rem] text-left text-sm">
                <thead class="bg-zinc-50 text-zinc-950 dark:bg-white/[0.035] dark:text-white">
                    <tr>
                        <th class="px-4 py-3 font-semibold" scope="col">What you see</th>
                        <th class="px-4 py-3 font-semibold" scope="col">What to do</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 text-zinc-600 dark:divide-white/10 dark:text-zinc-400">
                    <tr>
                        <td class="px-4 py-3 align-top">A inspector reports dropped or omitted records</td>
                        <td class="px-4 py-3 align-top">Increase the relevant capture limit only if needed, then reproduce. The old profile remains incomplete.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">An MCP response returns <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">next_cursor</code></td>
                        <td class="px-4 py-3 align-top">Use that cursor with the same profile, tool, path, and filters.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">A focused response omits deeper fields</td>
                        <td class="px-4 py-3 align-top">Follow <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">get-debug-profile-data</code> from <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">/inspectors</code> to the returned JSON Pointer paths.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">A retained string is chunked</td>
                        <td class="px-4 py-3 align-top">Read its next page of chunks and join them in order.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">A binding is masked or a key is hashed</td>
                        <td class="px-4 py-3 align-top">Review the capture-time policy, then capture again if exact values are needed.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </x-docs.section>

    <x-docs.section id="live" title="Was the evidence only available in the live browser?">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Livewire’s mounted state and some browser activity belong to the current page. Saved server profiles contain server-side evidence. A read-only MCP tool cannot edit a mounted component or recover browser-only activity after navigation.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">EXPLAIN is an explicit browser action. Its result is not a promise that the same plan was saved into the original profile. See <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.queries') }}">Queries</a> and <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.data-and-privacy') }}">Data and privacy</a> for these boundaries.</p>
    </x-docs.section>

    <x-docs.section id="verify" title="Repeat and compare one known fact">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Capture a fresh request after changing a setting. Check its new ID, the expected inspector, and one known operation or value. If processing fails, report the tool or storage error rather than treating all missing data as expiry.</p>
    </x-docs.section>
</x-layouts.docs>
