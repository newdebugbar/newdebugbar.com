@php
    $example1 = <<<'EXAMPLE1'
use Illuminate\Support\Facades\Http;

Http::fake([
    'partner.example.test/*' => Http::sequence()
        ->push(['error' => 'busy'], 503)
        ->push(['available' => true], 200),
]);

$response = Http::retry(2, 0)
    ->get('https://partner.example.test/availability');
EXAMPLE1;

    $example2 = <<<'EXAMPLE2'
expect($response->ok())->toBeTrue();
expect($response->json('available'))->toBeTrue();
Http::assertSentCount(2);
EXAMPLE2;

@endphp

<x-layouts.docs
    meta-title="Debug Laravel HTTP client requests | The New Debug Bar"
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
        ['id' => 'retry-example', 'label' => 'Example: one retry, then a successful response'],
        ['id' => 'payloads', 'label' => 'Read retained bodies and copied cURL carefully'],
        ['id' => 'same-contract', 'label' => 'Keep the remote contract while improving it'],
    ]"
>
    <x-docs.page-header category="Framework activity" title="See which outbound call held up the request">
        The New Debug Bar connects Laravel HTTP client requests to their response, duration, failure state, redacted payload, and application call site.
    </x-docs.page-header>

    <x-docs.screenshot name="http-client" alt="Outbound Laravel HTTP requests with statuses and timing" caption="The request list keeps completed responses and connection failures distinct, with source evidence available in the selected detail." />

    <x-docs.section id="captured" title="Inspect the request and response together">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">For supported Laravel HTTP client activity, the inspector retains method, safe URL, status, duration, bounded request and response headers and bodies, failure details, and a short application stack.</p>

        <x-docs.callout class="mt-6" title="Secrets are redacted during capture:">
            common credential headers, cookies, sensitive query parameters, and sensitive body keys are replaced before the profile is stored.
        </x-docs.callout>
    </x-docs.section>

    <x-docs.section id="slow" title="Separate remote wait from local work">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The inspector summary totals observed outbound HTTP duration. A call at or above <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">slow_http_request_ms</code> is marked as slow; the default threshold is 250 milliseconds.</p>

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

    <x-docs.section id="retry-example" title="Example: one retry, then a successful response">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Use a controlled sequence in a local example route to see how retries appear:</p>

        <x-docs.copyable-code class="mt-5" :code="$example1" copy-label="Copy retry example" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Inspect the two attempts in execution order. The first has an HTTP 503 response; the second has a 200 response. A connection failure is different because it has no response status.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Verify both the final response and the number of requests. In a focused test of this fake sequence:</p>

        <x-docs.copyable-code class="mt-5" :code="$example2" copy-label="Copy retry assertions" copy-success="Example copied" :multiline="true" />
    </x-docs.section>

    <x-docs.section id="payloads" title="Read retained bodies and copied cURL carefully">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The inspector can show bounded text or JSON request and response content. Multipart and binary bodies are omitted. Common credential fields and sensitive keys are redacted before storage.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">A copied cURL command represents retained content. It may need your local authentication or omitted body content restored before it can reproduce the real request. Read the command and its limitations before using it.</p>

        <x-docs.callout class="mt-6" title="Capture follows Laravel HTTP-client events">A separate HTTP library or raw cURL call does not automatically provide the same evidence. Confirm which client the application code uses.</x-docs.callout>
    </x-docs.section>

    <x-docs.section id="same-contract" title="Keep the remote contract while improving it">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">If the call is slow, use <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.performance') }}">Performance</a> to check how it affects the whole request. Test status handling, retry count, fallback data, and the app’s returned behavior before accepting a timing improvement.</p>
    </x-docs.section>

    <x-docs.next-step
        :href="route('docs.performance')"
        title="Place remote time in the full request"
        description="Use the request overview and timeline to compare outbound waits with database, rendering, and other application work."
        link-label="Open the performance guide"
    />
</x-layouts.docs>
