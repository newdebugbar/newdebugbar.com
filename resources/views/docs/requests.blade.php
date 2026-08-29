<x-layouts.docs
    meta-title="Inspect Laravel requests with New Debug Bar"
    description="Choose the correct Laravel request profile, read its overview and findings, and move through New Debug Bar without losing the request you are debugging."
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
    ]"
>
    <x-docs.page-header category="Getting started" title="Start with the right request">
        Every page load, redirect, fetch, and Livewire update can create its own profile. Select the request you meant to inspect before judging its data.
    </x-docs.page-header>

    <x-docs.section id="choose" title="Choose the request">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Open the bar at the bottom of your app. The request picker shows recent profiles with their method, path, status, type, and recorded time. Match those details to the action you just took.</p>

        <x-docs.figure class="mt-7" caption="The same request inspector image is reused anywhere this product view helps explain a workflow.">
            <x-screenshots.request-inspector
                alt="New Debug Bar request inspector showing a selected Laravel request profile"
                loading="lazy"
            />
        </x-docs.figure>

        <x-docs.callout class="mt-6" title="Need an exact profile ID?">
            The profiled response includes an <code class="font-mono text-[0.9em] text-zinc-900 dark:text-zinc-200">X-NewDebugBar-Profile</code> header. Use that ID in tests or with the local MCP server when several requests look similar.
        </x-docs.callout>
    </x-docs.section>

    <x-docs.section id="overview" title="Read the overview first">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The compact bar and request overview answer the first questions without making you open every section:</p>

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
            <x-docs.step number="2" title="Open one relevant section">
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

    <x-docs.next-step
        :href="route('docs.queries')"
        title="Trace database work"
        description="Learn how to separate slow queries, repeated query shapes, and likely N+1 behavior from normal database activity."
        link-label="Open the query guide"
    />
</x-layouts.docs>
