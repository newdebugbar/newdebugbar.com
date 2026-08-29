<x-layouts.docs
    meta-title="Debug Laravel Eloquent models | New Debug Bar"
    description="Inspect Eloquent model retrievals, writes, repeated records, changed attributes, application sources, and related queries with New Debug Bar."
    :canonical="url('/docs/eloquent')"
    og-title="Debug Eloquent model activity"
    og-description="Connect Laravel model retrievals and writes to their records, source code, timing, and database queries."
    page-title="Eloquent"
    :sections="[
        ['id' => 'overview', 'label' => 'Model activity'],
        ['id' => 'retrievals', 'label' => 'Retrievals'],
        ['id' => 'writes', 'label' => 'Writes'],
        ['id' => 'repeated', 'label' => 'Repeated records'],
        ['id' => 'queries', 'label' => 'Related queries'],
    ]"
>
    <x-docs.page-header category="Framework activity" title="See which Eloquent records moved through the request">
        Group model retrievals and lifecycle writes by class and source, then connect repeated records and changed attributes to the queries and code that produced them.
    </x-docs.page-header>

    <x-docs.section id="overview" title="Start with the model groups">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The Models section groups activity by model class, connection, table, source, and logical operation. This keeps a busy lifecycle readable without hiding the underlying retained records.</p>

        <ul class="mt-5 space-y-3" role="list">
            <x-docs.check-item>Use retrieval counts to spot models loaded more often than the page needs.</x-docs.check-item>
            <x-docs.check-item>Use record identifiers to see whether repetition affects the same rows or many different rows.</x-docs.check-item>
            <x-docs.check-item>Use source groups to separate model work started from different controllers, resources, jobs, or views.</x-docs.check-item>
            <x-docs.check-item>Use logical write operations instead of counting every Eloquent lifecycle event as a separate write.</x-docs.check-item>
        </ul>
    </x-docs.section>

    <x-docs.section id="retrievals" title="Investigate retrievals">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">A large retrieval count is not automatically a problem. Check how many unique records were loaded, whether the same record appears repeatedly, and which source caused each group.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">Repeated retrievals often point to relationship access in a loop, duplicated resource work, accessors that load data, or several layers requesting the same model. Confirm the matching query pattern before deciding whether eager loading, batching, or reuse is appropriate.</p>
    </x-docs.section>

    <x-docs.section id="writes" title="Review logical writes and changed attributes">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Created, updated, deleted, restored, trashed, and force-deleted model activity is folded into logical operations. Open one operation to inspect the record key, changed attributes, lifecycle events, timing, source, and related database work.</p>

        <x-docs.callout class="mt-6" title="Check intent as well as result:">
            an unexpected write may come from an observer, event listener, model hook, queued job, or shared service rather than the controller line where the request began.
        </x-docs.callout>
    </x-docs.section>

    <x-docs.section id="repeated" title="Use repetition as a lead">
        <ol class="mt-6 space-y-6" role="list">
            <x-docs.step number="1" title="Choose the repeated model group">
                Confirm the class, table, operation, record count, and source group.
            </x-docs.step>
            <x-docs.step number="2" title="Compare record identifiers">
                Decide whether one record is touched several times or a collection triggers one operation per record.
            </x-docs.step>
            <x-docs.step number="3" title="Open the source and related query">
                Follow the retained application location into the loop, relationship, resource, observer, or helper that controls it.
            </x-docs.step>
            <x-docs.step number="4" title="Repeat the same request">
                Confirm the model and query shape changed without removing needed lifecycle behavior.
            </x-docs.step>
        </ol>
    </x-docs.section>

    <x-docs.section id="queries" title="Connect models to database queries">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Model evidence explains what Eloquent did; query evidence explains what the database executed. Use source-based correlation and related query counts to move between the two views without assuming every query maps to one model event.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">When retrievals grow with a collection, open <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.queries') }}">Queries</a> to inspect normalized SQL, changing bindings, and likely N+1 findings.</p>
    </x-docs.section>

    <x-docs.next-step
        :href="route('docs.queries')"
        title="Inspect the SQL behind model work"
        description="Use repeated query shapes, bindings, duration, EXPLAIN, and application call sites to confirm the database cause."
        link-label="Open the query guide"
    />
</x-layouts.docs>
