<x-layouts.docs
    meta-title="Debug Laravel HTTP client requests | New Debug Bar"
    description="Inspect outbound Laravel HTTP client requests, responses, timing, failures, redacted headers and bodies, and application call sites."
    :canonical="url('/docs/http-client')"
    og-title="Debug Laravel HTTP client calls"
    og-description="See which remote call delayed or failed a Laravel request, what came back, and which application code sent it."
    page-title="HTTP client"
    :sections="[
        ['id' => 'captured', 'label' => 'What is captured'],
        ['id' => 'slow', 'label' => 'Slow requests'],
        ['id' => 'failures', 'label' => 'Failures'],
        ['id' => 'source', 'label' => 'Application source'],
        ['id' => 'verify', 'label' => 'Verify a change'],
    ]"
>
    <x-docs.page-header category="Framework activity" title="See which outbound call held up the request">
        New Debug Bar connects Laravel HTTP client requests to their response, duration, failure state, redacted payload, and application call site.
    </x-docs.page-header>

    <x-docs.section id="captured" title="Inspect the request and response together">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">For supported Laravel HTTP client activity, the inspector retains method, safe URL, status, duration, bounded request and response headers and bodies, failure details, and a short application stack.</p>

        <x-docs.callout class="mt-6" title="Secrets are redacted during capture:">
            common credential headers, cookies, sensitive query parameters, and sensitive body keys are replaced before the profile is stored.
        </x-docs.callout>
    </x-docs.section>

    <x-docs.section id="slow" title="Separate remote wait from local work">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The section summary totals observed outbound HTTP duration. A call at or above <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">slow_http_request_ms</code> is marked as slow; the default threshold is 250 milliseconds.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">Use the Timeline to see whether calls run one after another, repeat with similar URLs, or sit beside expensive local work. Then decide whether the source can batch, cache, defer, parallelize, or avoid the call.</p>
    </x-docs.section>

    <x-docs.section id="failures" title="Distinguish HTTP responses from connection failures">
        <ul class="mt-5 space-y-3" role="list">
            <x-docs.check-item>A completed response has an HTTP status and retained response details.</x-docs.check-item>
            <x-docs.check-item>A connection failure has no response status and includes the safe exception class and failure state.</x-docs.check-item>
            <x-docs.check-item>An application may accept a non-2xx status, so compare the status with the code path and expected remote contract.</x-docs.check-item>
            <x-docs.check-item>Retries can create several calls; inspect their order, URLs, duration, and source before treating them as duplicates.</x-docs.check-item>
        </ul>
    </x-docs.section>

    <x-docs.section id="source" title="Open the application call site">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Follow the first useful application frame into the service, action, job, controller, or client wrapper that sent the request. Inspect its timeout, retry policy, payload construction, and handling of non-success statuses.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">When several calls share the same wrapper, move down the retained stack to the caller that decided this request needed the remote data.</p>
    </x-docs.section>

    <x-docs.section id="verify" title="Verify the behavior, not only duration">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Repeat the same request with a controlled remote response or Laravel HTTP fake. Confirm call count, method, safe URL shape, status handling, fallback behavior, and request result before comparing duration.</p>
    </x-docs.section>

    <x-docs.next-step
        :href="route('docs.performance')"
        title="Place remote time in the full request"
        description="Use the request overview and timeline to compare outbound waits with database, rendering, and other application work."
        link-label="Open the performance guide"
    />
</x-layouts.docs>
