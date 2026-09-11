@php
    $diagram1 = [['title' => 'Locate', 'description' => 'List recent profiles or use the exact response-header ID.'], ['title' => 'Focus', 'description' => 'Read findings, one inspector, or a filtered query group.'], ['title' => 'Go deeper', 'description' => 'Follow JSON Pointer paths and returned pagination cursors.']];

    $example2 = <<<'EXAMPLE2'
{"path": "/trips/kyoto-autumn", "warning": true, "limit": 10}
EXAMPLE2;

    $example3 = <<<'EXAMPLE3'
{
  "profile_id": "PROFILE_ID",
  "inspector": "queries",
  "cursor": 0,
  "limit": 5
}
EXAMPLE3;

    $example4 = <<<'EXAMPLE4'
{"profile_id": "PROFILE_ID", "filter": "slow", "sort": "duration", "limit": 5}
EXAMPLE4;

    $example5 = <<<'EXAMPLE5'
{"profile_id": "PROFILE_ID", "cursor": 0, "limit": 10}
EXAMPLE5;

    $example6 = <<<'EXAMPLE6'
{
  "profile_id": "PROFILE_ID",
  "path": "/inspectors/queries/payload/records",
  "cursor": 0,
  "limit": 5
}
EXAMPLE6;

    $example7 = <<<'EXAMPLE7'
{
  "returned": 0,
  "total": 1,
  "truncated": true,
  "next_cursor": null,
  "omitted_due_to_bytes": 1
}
EXAMPLE7;

@endphp

<x-layouts.docs
    meta-title="MCP tool reference | The New Debug Bar"
    description="Reference the five MCP tools in The New Debug Bar, including arguments, defaults, filters, response limits, JSON Pointer paths, and error states."
    :canonical="url('/docs/mcp-tools')"
    og-title="MCP tool reference"
    og-description="Reference the five MCP tools in The New Debug Bar, including arguments, defaults, filters, response limits, JSON Pointer paths, and error states."
    page-title="MCP tool reference"
    :sections="[
        ['id' => 'conventions', 'label' => 'Shared conventions'],
        ['id' => 'list', 'label' => 'list-debug-profiles'],
        ['id' => 'inspector', 'label' => 'get-debug-profile-inspector'],
        ['id' => 'queries', 'label' => 'inspect-debug-queries'],
        ['id' => 'findings', 'label' => 'get-debug-findings'],
        ['id' => 'data', 'label' => 'get-debug-profile-data'],
        ['id' => 'pagination', 'label' => 'Finish the read without dropping evidence'],
    ]"
>
    <x-docs.page-header category="Reference" title="MCP tool reference">
        Read a concise result first. Follow paths and cursors when you need more of the retained evidence.
    </x-docs.page-header>

    <x-docs.flow :steps="$diagram1" caption="These are read-only tools over retained profiles; they do not run application actions." />

    <x-docs.section id="conventions" title="Shared conventions">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Replace <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">PROFILE_ID</code> in the examples with a real profile UUID. Tool names use hyphens; inspector names and structured fields use underscores where shown. Arguments below are JSON objects, not shell commands.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Structured responses use a <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">version</code>, a <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">status</code>, and a <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">data</code> object. The current response version is 2. The default maximum is 50 items per page and 100,000 bytes per response; <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.configuration') }}">configuration</a> can lower or raise those bounds.</p>

        <div class="mt-6 overflow-x-auto rounded-xl border border-zinc-200 dark:border-white/10">
            <table class="w-full min-w-[34rem] text-left text-sm">
                <thead class="bg-zinc-50 text-zinc-950 dark:bg-white/[0.035] dark:text-white">
                    <tr>
                        <th class="px-4 py-3 font-semibold" scope="col">Result</th>
                        <th class="px-4 py-3 font-semibold" scope="col">Meaning</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 text-zinc-600 dark:divide-white/10 dark:text-zinc-400">
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">ok</code></td>
                        <td class="px-4 py-3 align-top">The requested read completed. Check pagination for more retained data.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">not_found</code></td>
                        <td class="px-4 py-3 align-top">The requested profile, inspector, or path was not found. Inspect the returned context.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">partial</code> on a tool error</td>
                        <td class="px-4 py-3 align-top">Retained data is available, but background activity could not be refreshed. Read <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">background_error</code>; a null pending state is unknown.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Validation or processing error</td>
                        <td class="px-4 py-3 align-top">Fix the argument or reported processing problem. Do not assume the profile expired.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </x-docs.section>

    <x-docs.section id="list" title="list-debug-profiles">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">List recent summaries in the configured store. This tool is also useful for Artisan and worker profiles that are outside the browser’s current-page picker.</p>

        <div class="mt-6 overflow-x-auto rounded-xl border border-zinc-200 dark:border-white/10">
            <table class="w-full min-w-[34rem] text-left text-sm">
                <thead class="bg-zinc-50 text-zinc-950 dark:bg-white/[0.035] dark:text-white">
                    <tr>
                        <th class="px-4 py-3 font-semibold" scope="col">Argument</th>
                        <th class="px-4 py-3 font-semibold" scope="col">Default</th>
                        <th class="px-4 py-3 font-semibold" scope="col">Meaning</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 text-zinc-600 dark:divide-white/10 dark:text-zinc-400">
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">method</code></td>
                        <td class="px-4 py-3 align-top">Omitted</td>
                        <td class="px-4 py-3 align-top">Exact method; the tool normalizes it to uppercase.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">path</code></td>
                        <td class="px-4 py-3 align-top">Omitted</td>
                        <td class="px-4 py-3 align-top">Case-sensitive path fragment, up to 200 characters.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">status</code></td>
                        <td class="px-4 py-3 align-top">Omitted</td>
                        <td class="px-4 py-3 align-top">Exact HTTP status from 100 to 599.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">warning</code></td>
                        <td class="px-4 py-3 align-top">Omitted</td>
                        <td class="px-4 py-3 align-top">True for profiles with findings; false for profiles without them.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">limit</code></td>
                        <td class="px-4 py-3 align-top">10, capped by retention</td>
                        <td class="px-4 py-3 align-top">From 1 to the configured maximum retained profile count.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <x-docs.copyable-code class="mt-5" :code="$example2" copy-label="Copy profile-list example" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Read <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">data.profiles</code> and the list’s returned totals and truncation state. The list has no cursor argument. Narrow the filters or request a larger allowed limit when useful.</p>
    </x-docs.section>

    <x-docs.section id="inspector" title="get-debug-profile-inspector">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Read one inspector’s summary and a page of focused evidence. Required: <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">profile_id</code> and <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">inspector</code>. Optional: <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">cursor</code> defaults to 0; <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">limit</code> defaults to 5 and is capped by the item limit.</p>

        <x-docs.copyable-code class="mt-5" :code="$example3" copy-label="Copy inspector example" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Accepted inspector names are <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">overview</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">request</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">timeline</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">queries</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">http_client</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">queue</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">mail</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">notifications</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">redis</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">models</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">cache</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">views</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">events</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">authorization</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">validation</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">logs</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">exceptions</code>, and <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">livewire</code>. Use the available-inspector list for the selected profile; an accepted name need not be populated in every profile.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Focused responses intentionally summarize some fields. Use the generic data tool for retained detail such as folded model operations, complete exception causes, or individual view data.</p>
    </x-docs.section>

    <x-docs.section id="queries" title="inspect-debug-queries">
        <div class="mt-6 overflow-x-auto rounded-xl border border-zinc-200 dark:border-white/10">
            <table class="w-full min-w-[34rem] text-left text-sm">
                <thead class="bg-zinc-50 text-zinc-950 dark:bg-white/[0.035] dark:text-white">
                    <tr>
                        <th class="px-4 py-3 font-semibold" scope="col">Argument</th>
                        <th class="px-4 py-3 font-semibold" scope="col">Default</th>
                        <th class="px-4 py-3 font-semibold" scope="col">Meaning</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 text-zinc-600 dark:divide-white/10 dark:text-zinc-400">
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">profile_id</code></td>
                        <td class="px-4 py-3 align-top">Required</td>
                        <td class="px-4 py-3 align-top">The exact retained profile UUID.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">filter</code></td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">all</code></td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">all</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">repeated</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">slow</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">read</code>, or <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">write</code>.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">search</code></td>
                        <td class="px-4 py-3 align-top">Empty string</td>
                        <td class="px-4 py-3 align-top">Search retained SQL, driver, and binding evidence; up to 200 characters.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">sort</code></td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">execution</code></td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">execution</code> or <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">duration</code>; duration puts larger values first.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">cursor</code> / <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">limit</code></td>
                        <td class="px-4 py-3 align-top">0 / 5</td>
                        <td class="px-4 py-3 align-top">Read another bounded page with the same filters.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <x-docs.copyable-code class="mt-5" :code="$example4" copy-label="Copy slow-query example" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The repeated filter returns <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">data.repeated_groups</code>; other filters return <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">data.items</code>. A repeated group is not necessarily an N+1 problem. Read its bindings and source evidence.</p>
    </x-docs.section>

    <x-docs.section id="findings" title="get-debug-findings">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Required: <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">profile_id</code>. Optional: <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">cursor</code> defaults to 0 and <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">limit</code> defaults to 10, capped by the item limit. The result includes deterministic rule IDs, explanations, supporting evidence, and next checks under <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">data.findings</code>.</p>

        <x-docs.copyable-code class="mt-5" :code="$example5" copy-label="Copy findings example" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Treat findings as leads. Validate the actual operation and the app’s intended behavior before deciding that a denial, cache miss, or repeated query needs a change.</p>
    </x-docs.section>

    <x-docs.section id="data" title="get-debug-profile-data">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Required: <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">profile_id</code>. Optional: <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">path</code> defaults to <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">/inspectors</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">cursor</code> to 0, and <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">limit</code> to 10, capped by the item limit. An empty path reads the profile root. Paths use JSON Pointer syntax, up to 1,000 characters.</p>

        <x-docs.copyable-code class="mt-5" :code="$example6" copy-label="Copy deep-data example" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">An object or list returns entries with paths you can follow. A scalar uses <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">value</code>; a large retained string can use <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">chunks</code>. Follow the returned paths rather than guessing object keys or list indexes.</p>

        <div class="mt-6 overflow-x-auto rounded-xl border border-zinc-200 dark:border-white/10">
            <table class="w-full min-w-[34rem] text-left text-sm">
                <thead class="bg-zinc-50 text-zinc-950 dark:bg-white/[0.035] dark:text-white">
                    <tr>
                        <th class="px-4 py-3 font-semibold" scope="col">Evidence</th>
                        <th class="px-4 py-3 font-semibold" scope="col">Starting path</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 text-zinc-600 dark:divide-white/10 dark:text-zinc-400">
                    <tr>
                        <td class="px-4 py-3 align-top">Grouped query records and per-run evidence</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">/inspectors/queries/payload/records</code></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Folded model operations</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">/inspectors/models/payload/model_groups</code></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Normalized server Livewire activity</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">/inspectors/livewire/payload/activity_records</code></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">An exception’s retained causes</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">/inspectors/exceptions/payload/items/0/causes</code></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">A view occurrence’s retained data</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">/inspectors/views/payload/items/0/data</code></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">A Redis command’s application source</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">/inspectors/redis/payload/items/0/callsite</code></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The index 0 is illustrative. Choose the index returned for the record you actually want.</p>
    </x-docs.section>

    <x-docs.section id="pagination" title="Finish the read without dropping evidence">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Paged responses report <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">cursor</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">returned</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">total</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">truncated</code>, and <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">next_cursor</code>; byte-limited responses can also report <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">omitted_due_to_bytes</code>. Keep the same profile, tool, path, and filters when following the next cursor.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">A null <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">next_cursor</code> means there is no next page from that read. Check omission counts before concluding that all matching evidence was returned. With a small byte budget, a focused query group can be too large to fit:</p>

        <x-docs.copyable-code class="mt-5" :code="$example7" copy-label="Copy pagination result example" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">This result still has one matching retained group. Use <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">get-debug-profile-data</code> to walk its nested paths and read smaller pieces, or choose a suitable <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">mcp.max_bytes</code> budget. Lowering the item limit cannot make one oversized item smaller.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Join string chunks in their returned order. A response limit is different from capture truncation: another MCP page cannot recover data omitted before storage.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">For connection or data failures, use <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.troubleshooting.mcp') }}">MCP troubleshooting</a> and <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.troubleshooting.missing-profiles') }}">missing-profile checks</a>.</p>
    </x-docs.section>
</x-layouts.docs>
