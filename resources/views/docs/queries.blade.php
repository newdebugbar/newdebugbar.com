@php
    $example1 = <<<'EXAMPLE1'
$days = $trip->days()->get();

foreach ($days as $day) {
    $day->setRelation('bookings', $day->bookings()->get());
}
EXAMPLE1;

    $example2 = <<<'EXAMPLE2'
$days = $trip->days()->with('bookings')->get();
EXAMPLE2;

@endphp

<x-layouts.docs
    meta-title="Debug Laravel queries and N+1 problems | The New Debug Bar"
    description="Find slow and repeated Laravel database queries, inspect bindings and call sites, recognize likely N+1 behavior, and verify a fix."
    :canonical="url('/docs/queries')"
    og-title="Debug Laravel database queries"
    og-description="Use query evidence, bindings, source locations, and EXPLAIN to move from a symptom to the responsible application code."
    page-title="Queries"
    :sections="[
        ['id' => 'triage', 'label' => 'Triage query work'],
        ['id' => 'repeated', 'label' => 'Repeated queries'],
        ['id' => 'slow', 'label' => 'Slow queries'],
        ['id' => 'source', 'label' => 'Find the source'],
        ['id' => 'verify', 'label' => 'Verify the fix'],
        ['id' => 'example', 'label' => 'Work through an eight-day N+1 example'],
        ['id' => 'explain-availability', 'label' => 'Why EXPLAIN may be unavailable'],
        ['id' => 'transactions', 'label' => 'Read transaction boundaries with the query sequence'],
    ]"
>
    <x-docs.page-header category="Debugging workflows" title="Trace query cost back to Laravel code">
        Start with the request’s database shape, separate repeated work from slow work, and use bindings and application call sites to find the cause.
    </x-docs.page-header>

    <x-docs.screenshot name="queries" alt="Eight repeated booking queries with the same application call site" caption="The repeated group keeps each execution and its bindings together. The source points to the loop that controls the work." />

    <x-docs.section id="triage" title="Triage the database work">
        <ol class="mt-6 space-y-6" role="list">
            <x-docs.step number="1" title="Confirm the request">
                Match the method and path first. A background request can have a completely different query profile.
            </x-docs.step>
            <x-docs.step number="2" title="Compare count and total time">
                Many fast queries suggest repeated application work. A few expensive queries suggest database planning, indexing, locking, or transferred data.
            </x-docs.step>
            <x-docs.step number="3" title="Open findings and query groups">
                Use slow, repeated, and likely N+1 findings as shortcuts into the retained query evidence.
            </x-docs.step>
        </ol>

        <x-docs.callout class="mt-7" title="Keep the two costs separate:">
            query time is only the time The New Debug Bar observed around database execution. The full request also includes PHP, rendering, outbound HTTP, and other work.
        </x-docs.callout>
    </x-docs.section>

    <x-docs.section id="repeated" title="Investigate repeated queries and likely N+1 work">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The New Debug Bar groups queries with the same normalized SQL shape. Different bindings can reveal a loop that loads one related record at a time.</p>

        <ul class="mt-5 space-y-3" role="list">
            <x-docs.check-item>Check whether the repeated group grows with the number of models shown on the page.</x-docs.check-item>
            <x-docs.check-item>Compare bindings to see whether only an identifier changes between calls.</x-docs.check-item>
            <x-docs.check-item>Open the application call site and inspect the surrounding loop, resource, accessor, view, or relationship access.</x-docs.check-item>
            <x-docs.check-item>Look at the Models and Views inspectors for repeated retrieval or rendering that explains the query pattern.</x-docs.check-item>
        </ul>

        <x-docs.callout class="mt-6" tone="notice" title="Likely N+1 is a heuristic">
            Repetition can be intentional. Confirm that the count scales with the collection and that eager loading or a single aggregate query would preserve behavior before changing it.
        </x-docs.callout>
    </x-docs.section>

    <x-docs.section id="slow" title="Inspect a slow query">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Open the query detail and keep its SQL, bindings, duration, connection, and source together. Copy the bound query when you need to reproduce the exact local case.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">Use the EXPLAIN action to inspect the database plan for supported read queries. Look for a large scanned row count, an unexpected full scan, a costly sort, or an index that does not match the filters and ordering.</p>

        <x-docs.callout class="mt-6" title="EXPLAIN is evidence, not an automatic fix:">
            a plan depends on the database, schema, statistics, and bindings. Judge an index against real query patterns and write cost, not one local plan alone.
        </x-docs.callout>
    </x-docs.section>

    <x-docs.section id="source" title="Find the application source">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The source location and short application stack are usually more useful than the SQL text by itself. They show the controller, service, model, resource, or view path that caused the query.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">If the first frame is shared infrastructure, move down the retained application frames until you reach the caller that controls the work. Then inspect nearby relationship access, conditional loads, pagination, aggregates, or repeated helper calls.</p>
    </x-docs.section>

    <x-docs.section id="verify" title="Verify the fix on the same path">
        <ul class="mt-5 space-y-3" role="list">
            <x-docs.check-item>Repeat the same action with comparable records and a warm application.</x-docs.check-item>
            <x-docs.check-item>Confirm the repeated group or slow query disappeared for the intended reason.</x-docs.check-item>
            <x-docs.check-item>Check total query count, total query time, request duration, and returned behavior.</x-docs.check-item>
            <x-docs.check-item>Add a focused profile assertion when the query budget protects an important path.</x-docs.check-item>
        </ul>
    </x-docs.section>

    <x-docs.section id="example" title="Work through an eight-day N+1 example">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="https://github.com/newdebugbar/benchmark">Kyoto benchmark</a> has a Trip with eight days and a bookings relationship on each day. This loading step makes one day query and then one booking query per day:</p>

        <x-docs.copyable-code class="mt-5" :code="$example1" copy-label="Copy N+1 example" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Open the repeated booking query group. It has eight runs with different day IDs and the same application source. Confirm that relationship loading is the work the page needs, then replace the loop:</p>

        <x-docs.copyable-code class="mt-5" :code="$example2" copy-label="Copy eager-loading example" copy-success="Example copied" :multiline="true" />

        <div class="mt-6 overflow-x-auto rounded-xl border border-zinc-200 dark:border-white/10">
            <table class="w-full min-w-[34rem] text-left text-sm">
                <thead class="bg-zinc-50 text-zinc-950 dark:bg-white/[0.035]">
                    <tr>
                        <th class="px-4 py-3 font-semibold" scope="col">This loading step</th>
                        <th class="px-4 py-3 font-semibold" scope="col">Before</th>
                        <th class="px-4 py-3 font-semibold" scope="col">After</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 text-zinc-600 dark:divide-white/10 dark:text-zinc-400">
                    <tr>
                        <td class="px-4 py-3 align-top">Queries for days</td>
                        <td class="px-4 py-3 align-top">1</td>
                        <td class="px-4 py-3 align-top">1</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Queries for bookings</td>
                        <td class="px-4 py-3 align-top">8</td>
                        <td class="px-4 py-3 align-top">1</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Total</td>
                        <td class="px-4 py-3 align-top">9</td>
                        <td class="px-4 py-3 align-top">2</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">These are the counts for the isolated relationship-loading step. Other page queries remain. Compare the returned day IDs, booking IDs, and ordering before accepting the change.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">If each day needs a different filter, inspect that rule before applying the same eager load. See <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="https://laravel.com/framework/docs/13.x/eloquent-relationships#eager-loading">Laravel’s eager-loading guide</a>.</p>
    </x-docs.section>

    <x-docs.section id="explain-availability" title="Why EXPLAIN may be unavailable">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">EXPLAIN is an explicit action against the original configured connection. The package supports eligible read queries on MySQL, PostgreSQL, and SQLite; it does not run EXPLAIN ANALYZE.</p>

        <div class="mt-6 overflow-x-auto rounded-xl border border-zinc-200 dark:border-white/10">
            <table class="w-full min-w-[34rem] text-left text-sm">
                <thead class="bg-zinc-50 text-zinc-950 dark:bg-white/[0.035]">
                    <tr>
                        <th class="px-4 py-3 font-semibold" scope="col">Requirement or result</th>
                        <th class="px-4 py-3 font-semibold" scope="col">What to check</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 text-zinc-600 dark:divide-white/10 dark:text-zinc-400">
                    <tr>
                        <td class="px-4 py-3 align-top">Full, complete bindings are required</td>
                        <td class="px-4 py-3 align-top">Use the full binding policy and capture again if the old bindings were masked, omitted, or truncated.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Only one read query can be explained</td>
                        <td class="px-4 py-3 align-top">Use an eligible SELECT or read-only WITH query. Mutating, multi-statement, and locking queries are rejected.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">The connection is unavailable</td>
                        <td class="px-4 py-3 align-top">Restore the same configured connection and repeat the action.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">SQLite cannot find a table or function</td>
                        <td class="px-4 py-3 align-top">Check the database schema and connection-specific function registration.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Unsupported database driver</td>
                        <td class="px-4 py-3 align-top">Use your database client to inspect the plan.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">MySQL uses <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">EXPLAIN</code>, PostgreSQL uses <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">EXPLAIN (FORMAT JSON)</code>, and SQLite uses <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">EXPLAIN QUERY PLAN</code>. Their output fields differ. Treat a plan as a lead to confirm against the real schema and data.</p>

        <x-docs.callout class="mt-6" title="A plan is a current action">The plan is requested when you open it. It is not a measurement of the old query’s execution and is not automatically a saved-profile result available through MCP.</x-docs.callout>
    </x-docs.section>

    <x-docs.section id="transactions" title="Read transaction boundaries with the query sequence">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Begin, commit, and rollback markers help place SQL within a transaction on a particular connection. A rollback can explain why a captured write did not become a lasting database change. Check the actual database result as well as the marker.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">For a repeatable fix, continue with <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.testing') }}">Testing</a> or the <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.debugging-with-agents') }}">agent walkthrough</a>.</p>
    </x-docs.section>

    <x-docs.next-step
        :href="route('docs.performance')"
        title="Look beyond SQL"
        description="Use the timeline, request duration, HTTP calls, rendering, and memory when database time does not explain the page."
        link-label="Open the performance guide"
    />
</x-layouts.docs>
