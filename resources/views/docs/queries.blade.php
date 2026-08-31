<x-layouts.docs
    meta-title="Debug Laravel queries and N+1 problems | New Debug Bar"
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
    ]"
>
    <x-docs.page-header category="Debugging workflows" title="Trace query cost back to Laravel code">
        Start with the request’s database shape, separate repeated work from slow work, and use bindings and application call sites to find the cause.
    </x-docs.page-header>

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
            query time is only the time the New Debug Bar observed around database execution. The full request also includes PHP, rendering, outbound HTTP, and other work.
        </x-docs.callout>
    </x-docs.section>

    <x-docs.section id="repeated" title="Investigate repeated queries and likely N+1 work">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The New Debug Bar groups queries with the same normalized SQL shape. Different bindings can reveal a loop that loads one related record at a time.</p>

        <ul class="mt-5 space-y-3" role="list">
            <x-docs.check-item>Check whether the repeated group grows with the number of models shown on the page.</x-docs.check-item>
            <x-docs.check-item>Compare bindings to see whether only an identifier changes between calls.</x-docs.check-item>
            <x-docs.check-item>Open the application call site and inspect the surrounding loop, resource, accessor, view, or relationship access.</x-docs.check-item>
            <x-docs.check-item>Look at the Models and Views sections for repeated retrieval or rendering that explains the query pattern.</x-docs.check-item>
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

    <x-docs.next-step
        :href="route('docs.performance')"
        title="Look beyond SQL"
        description="Use the timeline, request duration, HTTP calls, rendering, and memory when database time does not explain the page."
        link-label="Open the performance guide"
    />
</x-layouts.docs>
