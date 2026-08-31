<x-layouts.docs
    meta-title="Debug Laravel queues and jobs | New Debug Bar"
    description="Inspect Laravel job dispatches, connections, queues, delays, synchronous execution, failures, and correlated queue-worker profiles."
    :canonical="url('/docs/queues')"
    og-title="Debug Laravel queues and jobs"
    og-description="Connect a web request that dispatches work to the queued job facts and worker profile that later executes it."
    page-title="Queues"
    :sections="[
        ['id' => 'dispatch', 'label' => 'Dispatch evidence'],
        ['id' => 'sync', 'label' => 'Synchronous jobs'],
        ['id' => 'background', 'label' => 'Worker activity'],
        ['id' => 'failures', 'label' => 'Failures'],
        ['id' => 'workflow', 'label' => 'Debugging workflow'],
    ]"
>
    <x-docs.page-header category="Framework activity" title="Follow queued work beyond the web request">
        Inspect what the request dispatched, where it went, and—when a local worker processes it—which separate worker profile records the result.
    </x-docs.page-header>

    <x-docs.section id="dispatch" title="Read the dispatch evidence">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The Queue section records bounded lifecycle facts such as the job class, queued or executed kind, connection, queue, job ID, delay, source, duration when available, and failure state.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">Use the application call site to answer why the job was dispatched. A job class tells you what can run; the source tells you which request path chose to run it.</p>
    </x-docs.section>

    <x-docs.section id="sync" title="Synchronous jobs finish in the same profile">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Jobs sent through the synchronous connection run during the current request. Their execution duration and failures belong to that request profile, so compare them with the Timeline and total duration.</p>

        <x-docs.callout class="mt-6" title="A queued record is different:">
            an asynchronous dispatch confirms that work was sent to a queue. It does not prove a worker completed it.
        </x-docs.callout>
    </x-docs.section>

    <x-docs.section id="background" title="Refresh correlated worker activity">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The New Debug Bar stores queue-worker executions as separate local profiles. Correlation facts can connect a dispatch, queued mail, or queued notification back to the worker profile that sent, completed, or failed it.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">If the original profile still shows pending background work, let the local worker process the job and refresh related activity. Open the worker profile for its own queries, logs, exceptions, model writes, mail, notifications, and duration.</p>
    </x-docs.section>

    <x-docs.section id="failures" title="Inspect the profile where the failure occurred">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">A dispatch failure in the web request and a later worker failure are different events. Use the origin profile for dispatch evidence and the worker profile for the exception, attempt facts, logs, and side effects produced while running the job.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">Retry attempts can point to more than one worker profile. Compare attempt number, status, exception class, and timing instead of treating the latest attempt as the whole history.</p>
    </x-docs.section>

    <x-docs.section id="workflow" title="Debug one queued operation">
        <ol class="mt-6 space-y-6" role="list">
            <x-docs.step number="1" title="Capture the origin request">Confirm the job, connection, queue, delay, and dispatch source.</x-docs.step>
            <x-docs.step number="2" title="Run the local worker">Let the same queue process the job while the New Debug Bar is running.</x-docs.step>
            <x-docs.step number="3" title="Refresh related activity">Open the correlated worker profile instead of expecting worker evidence in the web profile.</x-docs.step>
            <x-docs.step number="4" title="Inspect the worker cause">Use Exceptions, Logs, Queries, Models, Mail, and Notifications inside that worker profile.</x-docs.step>
        </ol>
    </x-docs.section>

    <x-docs.next-step
        :href="route('docs.mail-and-notifications')"
        title="Inspect queued communication"
        description="Preview mail, review notification channels, and follow queued delivery into its related worker outcome."
        link-label="Open mail and notifications"
    />
</x-layouts.docs>
