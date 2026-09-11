@php
    $example1 = <<<'EXAMPLE1'
BuildJourneySnapshot::dispatch($trip->id)
    ->onConnection('database')
    ->onQueue('journeys');
EXAMPLE1;

    $example2 = <<<'EXAMPLE2'
php artisan queue:work database --queue=journeys --once
EXAMPLE2;

    $diagram3 = [['title' => 'Origin request', 'description' => 'The dispatch records the job, target queue, and source.'], ['title' => 'Worker attempt', 'description' => 'A job profile records the work, failure, or completion of one attempt.'], ['title' => 'Related activity', 'description' => 'The origin can link to retained worker results when correlation data is available.']];

@endphp

<x-layouts.docs
    meta-title="Debug Laravel queues and jobs | The New Debug Bar"
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
        ['id' => 'dispatch-example', 'label' => 'Example: follow a job on a local database queue'],
        ['id' => 'pending', 'label' => 'If the job remains pending'],
        ['id' => 'attempts', 'label' => 'Compare attempts without losing the cause'],
    ]"
>
    <x-docs.page-header category="Framework activity" title="Follow queued work beyond the web request">
        Inspect what the request dispatched, where it went, and—when a local worker processes it—which separate worker profile records the result.
    </x-docs.page-header>

    <x-docs.screenshot name="queues" alt="A completed synchronous job and a failed synchronous job" caption="These two jobs ran in the selected request. An asynchronous worker’s result belongs to a separate profile." />

    <x-docs.section id="dispatch" title="Read the dispatch evidence">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The Queue inspector records bounded lifecycle facts such as the job class, queued or executed kind, connection, queue, job ID, delay, source, duration when available, and failure state.</p>

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
            <x-docs.step number="2" title="Run the local worker">Let the same queue process the job while The New Debug Bar is running.</x-docs.step>
            <x-docs.step number="3" title="Refresh related activity">Open the correlated worker profile instead of expecting worker evidence in the web profile.</x-docs.step>
            <x-docs.step number="4" title="Inspect the worker cause">Use Exceptions, Logs, Queries, Models, Mail, and Notifications inside that worker profile.</x-docs.step>
        </ol>
    </x-docs.section>

    <x-docs.section id="dispatch-example" title="Example: follow a job on a local database queue">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Use an existing configured queue with its required tables. In an app where BuildJourneySnapshot is a queued job, send one local example to a named queue:</p>

        <x-docs.copyable-code class="mt-5" :code="$example1" copy-label="Copy dispatch example" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Record the origin response ID, then run a worker for that same connection and queue:</p>

        <x-docs.copyable-code class="mt-5" :code="$example2" copy-label="Copy local worker command" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The class and queue name belong to the example app. Use your own job and queue. Check that the worker has the package enabled in an allowed environment and can read the relevant profile storage.</p>
    </x-docs.section>

    <x-docs.section id="pending" title="If the job remains pending">
        <div class="mt-6 overflow-x-auto rounded-xl border border-zinc-200 dark:border-white/10">
            <table class="w-full min-w-[34rem] text-left text-sm">
                <thead class="bg-zinc-50 text-zinc-950 dark:bg-white/[0.035]">
                    <tr>
                        <th class="px-4 py-3 font-semibold" scope="col">Check</th>
                        <th class="px-4 py-3 font-semibold" scope="col">Why it matters</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 text-zinc-600 dark:divide-white/10 dark:text-zinc-400">
                    <tr>
                        <td class="px-4 py-3 align-top">Connection and queue</td>
                        <td class="px-4 py-3 align-top">A worker listening elsewhere will not take this job.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Delay and availability</td>
                        <td class="px-4 py-3 align-top">A delayed job may not be eligible yet.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Worker environment and loaded code</td>
                        <td class="px-4 py-3 align-top">A long-lived worker may need a restart after a configuration or code change.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Profile directory and correlation data</td>
                        <td class="px-4 py-3 align-top">Processes need access to the retained evidence to connect origin and worker profiles.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Retention</td>
                        <td class="px-4 py-3 align-top">The originating profile can expire before you inspect the result.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Refresh related activity in the original profile after the worker runs. If refresh reports an error, keep that error separate from the job’s actual status.</p>
    </x-docs.section>

    <x-docs.section id="attempts" title="Compare attempts without losing the cause">
        <x-docs.flow :steps="$diagram3" caption="An accepted dispatch and a completed worker attempt are different facts." />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Retries can create more than one worker profile. Compare attempt number, duration, exception, and side effects. A later success does not explain why the first attempt failed.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">For queued mail or notification delivery, continue with <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.mail-and-notifications') }}">Mail and notifications</a>.</p>
    </x-docs.section>

    <x-docs.next-step
        :href="route('docs.mail-and-notifications')"
        title="Inspect queued communication"
        description="Preview mail, review notification channels, and follow queued delivery into its related worker outcome."
        link-label="Open mail and notifications"
    />
</x-layouts.docs>
