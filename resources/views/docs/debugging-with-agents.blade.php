@php
    $example1 = <<<'EXAMPLE1'
Debug the itinerary request using The New Debug Bar profile PROFILE_ID.
Find why booking queries repeat, trace the evidence to application code,
make the smallest useful fix, then repeat the request and run a focused test.
Keep the itinerary days, bookings, and ordering unchanged.
Report the before-and-after evidence and any remaining uncertainty.
EXAMPLE1;

    $example2 = <<<'EXAMPLE2'
{
  "profile_id": "PROFILE_ID",
  "filter": "repeated",
  "search": "bookings",
  "cursor": 0,
  "limit": 5
}
EXAMPLE2;

    $example3 = <<<'EXAMPLE3'
$days = $trip->days()->get();

foreach ($days as $day) {
    $day->setRelation('bookings', $day->bookings()->get());
}
EXAMPLE3;

    $example4 = <<<'EXAMPLE4'
$days = $trip->days()->with('bookings')->get();
EXAMPLE4;

@endphp

<x-layouts.docs
    meta-title="Fix a Laravel problem with exact profile data | The New Debug Bar"
    description="Use The New Debug Bar MCP server to take a Laravel N+1 problem from an exact request profile to a code change and verification."
    :canonical="url('/docs/debugging-with-agents')"
    og-title="Fix a Laravel problem with exact profile data"
    og-description="Use The New Debug Bar MCP server to take a Laravel N+1 problem from an exact request profile to a code change and verification."
    page-title="Debug with an agent"
    :sections="[
        ['id' => 'reproduce', 'label' => 'Start with one reproducible action'],
        ['id' => 'findings', 'label' => 'Read findings, then one focused query group'],
        ['id' => 'change', 'label' => 'Change the caller that repeats the work'],
        ['id' => 'verify', 'label' => 'Capture again and compare like with like'],
        ['id' => 'incomplete', 'label' => 'Handle incomplete evidence explicitly'],
    ]"
>
    <x-docs.page-header category="Use with agents" title="Fix a Laravel problem with exact profile data">
        Give the agent a reproducible action and its profile ID. It can follow the captured evidence, change the application code, and verify the same behavior.
    </x-docs.page-header>

    <x-docs.screenshot name="queries" alt="A repeated booking query with eight runs and its application call site" caption="The browser and MCP read the same retained query evidence. This group points to one booking lookup per itinerary day." />

    <x-docs.section id="reproduce" title="Start with one reproducible action">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Connect the <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.mcp') }}">local MCP server</a>, visit the affected page, and copy its <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">X-NewDebugBar-Profile</code> response header. State the symptom and any behavior the fix must preserve.</p>

        <x-docs.copyable-code class="mt-5" :code="$example1" copy-label="Copy agent prompt" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Replace <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">PROFILE_ID</code> with your request’s ID. If the agent must locate it, have it match method, path, type, status, and recorded time.</p>
    </x-docs.section>

    <x-docs.section id="findings" title="Read findings, then one focused query group">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">First call <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">get-debug-findings</code> for the ID. For the repeated-bookings lead, use <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">inspect-debug-queries</code> with these arguments:</p>

        <x-docs.copyable-code class="mt-5" :code="$example2" copy-label="Copy repeated-query arguments" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Inspect the execution count, differing bindings, and retained call site. In the illustrated example, eight itinerary days cause eight booking reads from the same application line. That is stronger evidence than a high total query count alone.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">When a focused result leaves out a detail, use <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">get-debug-profile-data</code> from <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">/inspectors/queries/payload/records</code> and follow the returned paths. The <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.mcp-tools') }}">tool reference</a> explains pagination and failures.</p>
    </x-docs.section>

    <x-docs.section id="change" title="Change the caller that repeats the work">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The example loads each day’s bookings in a loop:</p>

        <x-docs.copyable-code class="mt-5" :code="$example3" copy-label="Copy repeated-loading example" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Eager loading lets Laravel fetch bookings for the complete set of days:</p>

        <x-docs.copyable-code class="mt-5" :code="$example4" copy-label="Copy eager-loading change" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The agent should inspect the relationship definition and any filters or ordering before making this change. A different per-day condition may require a different solution.</p>
    </x-docs.section>

    <x-docs.section id="verify" title="Capture again and compare like with like">
        <div class="mt-6 overflow-x-auto rounded-xl border border-zinc-200 dark:border-white/10">
            <table class="w-full min-w-[34rem] text-left text-sm">
                <thead class="bg-zinc-50 text-zinc-950 dark:bg-white/[0.035] dark:text-white">
                    <tr>
                        <th class="px-4 py-3 font-semibold" scope="col">Relationship-loading example</th>
                        <th class="px-4 py-3 font-semibold" scope="col">Before</th>
                        <th class="px-4 py-3 font-semibold" scope="col">After</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 text-zinc-600 dark:divide-white/10 dark:text-zinc-400">
                    <tr>
                        <td class="px-4 py-3 align-top">Day queries</td>
                        <td class="px-4 py-3 align-top">1</td>
                        <td class="px-4 py-3 align-top">1</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Booking queries for eight days</td>
                        <td class="px-4 py-3 align-top">8</td>
                        <td class="px-4 py-3 align-top">1</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Queries in this isolated loading step</td>
                        <td class="px-4 py-3 align-top">9</td>
                        <td class="px-4 py-3 align-top">2</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">These counts describe the day-and-booking loading step, not every query in the full benchmark page. Use the new response ID after the change. Compare returned day and booking IDs and ordering, then check the affected query group.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Add a focused query-budget or response test using <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.testing') }}">profile assertions</a>. A smaller count is useful only if the required response still works.</p>
    </x-docs.section>

    <x-docs.section id="incomplete" title="Handle incomplete evidence explicitly">
        <ul class="mt-5 space-y-3" role="list">
            <x-docs.check-item>If the ID expired, reproduce and capture a new one.</x-docs.check-item>
            <x-docs.check-item>If the tool returns another page, follow its cursor instead of treating the first page as the full list.</x-docs.check-item>
            <x-docs.check-item>If background refresh failed, use retained data and report what could not be refreshed.</x-docs.check-item>
            <x-docs.check-item>If a value was not retained, inspect the app code or reproduce with the needed capture setting.</x-docs.check-item>
        </ul>

        <x-docs.callout class="mt-6" title="The MCP tools provide evidence">All five tools are read-only. Code changes and browser interactions use the agent’s normal development tools. MCP itself does not edit Livewire properties or execute a browser EXPLAIN action.</x-docs.callout>
    </x-docs.section>

    <x-docs.next-step
        :href="route('docs.testing')"
        title="Keep the improvement covered"
        description="Turn a verified fix into a small request-profile regression test."
        link-label="Read the guide"
    />
</x-layouts.docs>
