@php
    $example1 = <<<'EXAMPLE1'
curl -i http://your-app.test/api/trips
EXAMPLE1;

@endphp

<x-layouts.docs
    meta-title="Inspect Laravel requests with The New Debug Bar"
    description="Choose the correct Laravel request profile, read its overview and findings, and move through The New Debug Bar without losing the request you are debugging."
    :canonical="url('/docs/requests')"
    og-title="Inspect Laravel request profiles"
    og-description="A practical workflow for selecting and understanding the exact request you need to debug."
    page-title="Requests"
    :sections="[
        ['id' => 'choose', 'label' => 'Choose the request'],
        ['id' => 'overview', 'label' => 'Read the overview'],
        ['id' => 'findings', 'label' => 'Use findings'],
        ['id' => 'inspect', 'label' => 'Follow the evidence'],
        ['id' => 'background', 'label' => 'Background requests'],
        ['id' => 'response-types', 'label' => 'Inspect APIs, redirects, downloads, and streams'],
        ['id' => 'navigation', 'label' => 'Follow navigation without losing the request'],
        ['id' => 'workspace', 'label' => 'Make the inspector useful for your workflow'],
    ]"
>
    <x-docs.page-header category="Getting started" title="Start with the right request">
        Every page load, redirect, fetch, and Livewire update can create its own profile. Select the request you meant to inspect before judging its data.
    </x-docs.page-header>

    <x-docs.section id="choose" title="Choose the request">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Open the bar at the bottom of your app. The request picker shows profiles discovered on this page with their method, path, status, type, and recorded time. Match those details to the action you just took.</p>

        <x-docs.screenshot name="requests" alt="The request trace from incoming URL through route matching to the response" caption="Confirm the incoming request, matched route, and final response before following another inspector." />

        <x-docs.callout class="mt-6" title="Need an exact profile ID?">
            The profiled response includes an <code class="font-mono text-[0.9em] text-zinc-900 dark:text-zinc-200">X-NewDebugBar-Profile</code> header. Use that ID in tests or with the local MCP server when several requests look similar.
        </x-docs.callout>
    </x-docs.section>

    <x-docs.section id="overview" title="Read the overview first">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The compact bar and request overview answer the first questions without making you open every inspector:</p>

        <ul class="mt-5 space-y-3" role="list">
            <x-docs.check-item><strong class="font-semibold text-zinc-950 dark:text-white">What happened:</strong> method, path, request type, status, and duration.</x-docs.check-item>
            <x-docs.check-item><strong class="font-semibold text-zinc-950 dark:text-white">What needs attention:</strong> errors and findings appear before quiet diagnostics.</x-docs.check-item>
            <x-docs.check-item><strong class="font-semibold text-zinc-950 dark:text-white">Where time went:</strong> total query time, query count, and peak memory give you an initial direction.</x-docs.check-item>
        </ul>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">A high total duration with little database time points away from SQL. A large query count or repeated-query finding points toward the <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.queries') }}">Queries inspector</a>.</p>
    </x-docs.section>

    <x-docs.section id="findings" title="Treat findings as leads">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Findings turn captured evidence into likely debugging leads: a slow request, repeated query shape, failed HTTP call, high cache miss rate, or another unusual pattern.</p>

        <x-docs.callout class="mt-6" tone="notice" title="A finding is not a verdict">
            Local data can be unusual for a valid reason. Open the source evidence, confirm that the work is unexpected, and compare another request before changing code.
        </x-docs.callout>
    </x-docs.section>

    <x-docs.section id="inspect" title="Follow the evidence in a small loop">
        <ol class="mt-6 space-y-6" role="list">
            <x-docs.step number="1" title="State the symptom">
                Name the visible problem: a failed page, repeated database work, a slow update, or an unexpected side effect.
            </x-docs.step>
            <x-docs.step number="2" title="Open one relevant inspector">
                Use the finding or overview to choose Queries, Timeline, Exceptions, HTTP client, Livewire, or another focused inspector.
            </x-docs.step>
            <x-docs.step number="3" title="Trace it to application code">
                Use the source location, call stack, related query, model, or event instead of guessing from a count alone.
            </x-docs.step>
            <x-docs.step number="4" title="Repeat the request">
                Refresh or repeat the same action after a change. Compare like with like and keep the selected request type the same.
            </x-docs.step>
        </ol>
    </x-docs.section>

    <x-docs.section id="background" title="Watch for background requests">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The newest profile is not always the page you care about. A Livewire update, polling request, asset-related fetch, or application request made after the main response may be newer.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">Reselect the profile by method and path after the list refreshes. When an agent or test needs certainty, pass the exact response-header ID instead of saying “the latest request.”</p>
    </x-docs.section>

    <x-docs.section id="response-types" title="Inspect APIs, redirects, downloads, and streams">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">A request can be captured without receiving toolbar HTML. JSON, redirects, downloads, and streamed responses preserve their response format. Read the profile header and use MCP when there is no HTML page to host the bar.</p>

        <x-docs.copyable-code class="mt-5" :code="$example1" copy-label="Copy API inspection example" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Replace that example URL with an existing local route. Read <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">X-NewDebugBar-Profile</code> from the response and pass its value to your agent. For redirects, identify the response whose work you need; the destination page is another request.</p>

        <div class="mt-6 overflow-x-auto rounded-xl border border-zinc-200 dark:border-white/10">
            <table class="w-full min-w-[34rem] text-left text-sm">
                <thead class="bg-zinc-50 text-zinc-950 dark:bg-white/[0.035]">
                    <tr>
                        <th class="px-4 py-3 font-semibold" scope="col">Profile</th>
                        <th class="px-4 py-3 font-semibold" scope="col">How to find it</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 text-zinc-600 dark:divide-white/10 dark:text-zinc-400">
                    <tr>
                        <td class="px-4 py-3 align-top">A page, later fetch, XHR, or Livewire update discovered on this page</td>
                        <td class="px-4 py-3 align-top">Use the current-page picker and match method, path, type, and time.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">A separate API client request or an older retained request</td>
                        <td class="px-4 py-3 align-top">Use its exact ID or list retained profiles through MCP.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">An Artisan command</td>
                        <td class="px-4 py-3 align-top">Use <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.artisan') }}">Artisan command profiling</a>.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">A worker job</td>
                        <td class="px-4 py-3 align-top">Use a correlated worker link or find the retained worker profile through MCP.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </x-docs.section>

    <x-docs.section id="navigation" title="Follow navigation without losing the request">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Supported Livewire navigation and foreground Inertia visits can move the active page context. A partial reload or other background request can appear without taking over your selected profile. Recheck identity when the browser changes pages.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">This request support is not a dedicated Inertia component or props inspector. Use the captured request and framework evidence that is actually present.</p>
    </x-docs.section>

    <x-docs.section id="workspace" title="Make the inspector useful for your workflow">
        <ul class="mt-5 space-y-3" role="list">
            <x-docs.check-item>Drag the compact toolbar to the top, bottom, or a corner. The command palette offers the same placement actions.</x-docs.check-item>
            <x-docs.check-item>Favorite the inspectors you use together and reorder them through the interface.</x-docs.check-item>
            <x-docs.check-item>Press Command/Ctrl + Shift + P to find a inspector or action.</x-docs.check-item>
            <x-docs.check-item>On a small screen, use the inspector actions menu to switch inspectors, change theme, or open the command palette.</x-docs.check-item>
            <x-docs.check-item>Source controls copy an application location. Paste it into your editor or agent when you need the file and line.</x-docs.check-item>
        </ul>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">If a request or retained value seems absent, follow <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.troubleshooting.missing-profiles') }}">Find missing profiles and data</a>.</p>
    </x-docs.section>

    <x-docs.next-step
        :href="route('docs.queries')"
        title="Trace database work"
        description="Learn how to separate slow queries, repeated query shapes, and likely N+1 behavior from normal database activity."
        link-label="Open the query guide"
    />
</x-layouts.docs>
