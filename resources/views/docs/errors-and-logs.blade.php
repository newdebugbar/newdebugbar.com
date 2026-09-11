@php
    $example1 = <<<'EXAMPLE1'
try {
    throw new RuntimeException('The local partner example is unavailable.');
} catch (RuntimeException $exception) {
    report($exception);

    Log::warning('Using the saved availability result.', [
        'trip_id' => $trip->id,
    ]);
}

return response()->json(['source' => 'saved']);
EXAMPLE1;

@endphp

<x-layouts.docs
    meta-title="Debug Laravel exceptions and logs | The New Debug Bar"
    description="Inspect Laravel error responses, reported exceptions, causes, application frames, source context, log messages, context, channels, and call sites."
    :canonical="url('/docs/errors-and-logs')"
    og-title="Debug Laravel exceptions and logs"
    og-description="Follow an error response or log message from the request overview to the exact application path and retained context."
    page-title="Errors and logs"
    :sections="[
        ['id' => 'start', 'label' => 'Start with the request'],
        ['id' => 'exceptions', 'label' => 'Exceptions'],
        ['id' => 'causes', 'label' => 'Causes and frames'],
        ['id' => 'logs', 'label' => 'Logs'],
        ['id' => 'workflow', 'label' => 'Debugging workflow'],
        ['id' => 'reported-example', 'label' => 'Example: an exception with a successful response'],
        ['id' => 'log-example', 'label' => 'Connect a message to its request and source'],
        ['id' => 'verify-fallback', 'label' => 'Verify the failure path and recovery'],
    ]"
>
    <x-docs.page-header category="Debugging workflows" title="Follow failures and log context back to code">
        Use the request status and findings to find the relevant exception, then inspect application frames, retained causes, source context, and nearby log entries.
    </x-docs.page-header>

    <x-docs.screenshot name="exceptions" alt="A reported exception with its application source and surrounding code" caption="The failure points to SyncRailReservation and retains the code around the throwing line." />

    <x-docs.section id="start" title="Start with the selected request">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Confirm the method, path, request type, and time. A failed background request can appear after a successful page response, and an exception may be reported even when application code catches it and returns a normal status.</p>

        <x-docs.callout class="mt-6" title="Status and exceptions answer different questions:">
            the HTTP status tells you how the response ended. Exceptions shows failures Laravel reported during the selected profile.
        </x-docs.callout>
    </x-docs.section>

    <x-docs.section id="exceptions" title="Open the exception summary">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Use the exception class, message, occurrence count, and first application location to choose the failure that matches the symptom. Repeated reports of the same logical exception stay grouped so one cause does not dominate the view.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">Open the detail for its application path and source context. Framework frames remain available for deeper tracing, but begin where your application first enters the failing path.</p>
    </x-docs.section>

    <x-docs.section id="causes" title="Read retained causes and frames">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Wrapped exceptions can preserve a chain of causes. Follow the chain until the message and location explain the original failure, then move outward to see how application code handled or transformed it.</p>

        <ul class="mt-5 space-y-3" role="list">
            <x-docs.check-item>Application frames show the code path you control.</x-docs.check-item>
            <x-docs.check-item>Vendor frames show framework or package behavior when deeper context is needed.</x-docs.check-item>
            <x-docs.check-item>Source context keeps the failing line with nearby code within the configured limit.</x-docs.check-item>
            <x-docs.check-item>Related logs, queries, HTTP calls, and timeline items can explain what happened immediately before the failure.</x-docs.check-item>
        </ul>
    </x-docs.section>

    <x-docs.section id="logs" title="Use logs as request-scoped context">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The Logs inspector keeps level, message, bounded context, channel information, and the application source that wrote each retained entry. Because the entries belong to one profile, you do not need to search a large log file by time alone.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">Start with warning and error levels, but keep lower-level entries when they record the state transition or external identifier that explains the failure. Common sensitive keys are redacted during capture.</p>
    </x-docs.section>

    <x-docs.section id="workflow" title="Use one evidence loop">
        <ol class="mt-6 space-y-6" role="list">
            <x-docs.step number="1" title="Reproduce one failing action">Capture the exact request and note its profile ID.</x-docs.step>
            <x-docs.step number="2" title="Open the first application failure">Read the message, causes, application frame, and source context.</x-docs.step>
            <x-docs.step number="3" title="Check nearby evidence">Use the timeline and related logs, queries, or HTTP calls to test the likely cause.</x-docs.step>
            <x-docs.step number="4" title="Repeat after the change">Confirm the request behavior and <em>all</em> error findings, not only the original message.</x-docs.step>
        </ol>
    </x-docs.section>

    <x-docs.section id="reported-example" title="Example: an exception with a successful response">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">A local route can report a failure, choose a fallback, and still return a successful response:</p>

        <x-docs.copyable-code class="mt-5" :code="$example1" copy-label="Copy reported-failure example" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Use the normal RuntimeException class and Laravel Log facade in an isolated local example. Capture the response, then compare its 200 status with Exceptions and Logs. The response succeeded because the code selected a fallback; the reported failure remains useful evidence.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">A caught exception that was never reported or otherwise captured may not appear. Follow the app’s reporting path before treating its absence as a collector failure.</p>
    </x-docs.section>

    <x-docs.section id="log-example" title="Connect a message to its request and source">
        <x-docs.screenshot name="logs" alt="Request-scoped warning and information logs with retained context" caption="The Logs inspector groups repeated entries while preserving their occurrence count and application source." />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Open the warning’s context and source, then check the nearby exception or HTTP operation. Include concrete, small context when writing your own log message: an operation, a local record ID, or a state transition is more useful than a large object dump.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">For wrapped exceptions, follow retained causes toward the original failure. For handled form feedback, use <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.validation') }}">Validation</a> rather than treating every validation message as an application crash.</p>
    </x-docs.section>

    <x-docs.section id="verify-fallback" title="Verify the failure path and recovery">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Check both the recorded error and the behavior the user received. Test the fallback response, then repeat with the dependency available and confirm the successful path. Removing a log message is not a fix for the underlying failure.</p>
    </x-docs.section>

    <x-docs.next-step
        :href="route('docs.testing')"
        title="Protect an error-free path"
        description="Use a stored response profile in Pest to assert that an important request has no error response or exception finding."
        link-label="Open the testing guide"
    />
</x-layouts.docs>
