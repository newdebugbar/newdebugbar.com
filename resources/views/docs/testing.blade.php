@php
    $diagram1 = [['title' => 'Capture the response', 'description' => 'Enable profiling before the test app boots and make the real request.'], ['title' => 'Use its exact ID', 'description' => 'Read X-NewDebugBar-Profile rather than choosing the latest stored profile.'], ['title' => 'Assert the contract', 'description' => 'Check response behavior and the stable query or error budget that matters.']];

    $example2 = <<<'EXAMPLE2'
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use NewDebugBar\Testing\ProfileAssertions;

use function Pest\Laravel\get;

it('captures the example response within its query budget', function () {
    Route::get('/profile-example', function () {
        $result = DB::selectOne('select 1 as value');

        return response()->json(['value' => (int) $result->value]);
    });

    $response = get('/profile-example')
        ->assertOk()
        ->assertExactJson(['value' => 1])
        ->assertHeader('X-NewDebugBar-Profile');

    ProfileAssertions::stored(
        (string) $response->headers->get('X-NewDebugBar-Profile'),
    )
        ->assertNoErrors()
        ->assertQueryCountAtMost(1)
        ->assertNoLikelyNPlusOneQueries();
});
EXAMPLE2;

    $example3 = <<<'EXAMPLE3'
ProfileAssertions::for($profile)
    ->assertQueryCountAtMost(12)
    ->assertQueryTimeAtMost(100);
EXAMPLE3;

@endphp

@php
    $profileTest = '<'.'?php'."\n\n".<<<'PHP'
use NewDebugBar\Testing\ProfileAssertions;

use function Pest\Laravel\get;

it('keeps the dashboard profile within its budget', function () {
    $response = get('/dashboard')
        ->assertOk()
        ->assertHeader('X-NewDebugBar-Profile');

    ProfileAssertions::stored(
        (string) $response->headers->get('X-NewDebugBar-Profile'),
    )
        ->assertNoErrors()
        ->assertQueryCountAtMost(12)
        ->assertNoLikelyNPlusOneQueries()
        ->assertDurationAtMost(300);
});
PHP;
@endphp

<x-layouts.docs
    meta-title="Test Laravel request profiles with Pest | The New Debug Bar"
    description="Enable The New Debug Bar in Laravel's testing environment and use Pest profile assertions for errors, queries, N+1 behavior, duration, query time, and peak memory."
    :canonical="url('/docs/testing')"
    og-title="Test Laravel request profiles with Pest"
    og-description="Turn the exact response profile ID from The New Debug Bar into focused performance and correctness assertions."
    page-title="Testing"
    :sections="[
        ['id' => 'enable', 'label' => 'Enable profiling'],
        ['id' => 'profile-id', 'label' => 'Use the profile ID'],
        ['id' => 'assertions', 'label' => 'Available assertions'],
        ['id' => 'example', 'label' => 'Pest example'],
        ['id' => 'budgets', 'label' => 'Choose stable budgets'],
        ['id' => 'complete-example', 'label' => 'Run a small profile assertion without extra models'],
        ['id' => 'supplied-profile', 'label' => 'Assert a supplied profile when you already have it'],
        ['id' => 'missing-header', 'label' => 'If the test response has no profile header'],
    ]"
>
    <x-docs.page-header category="Reference" title="Protect important request profiles with Pest">
        Capture the real Laravel response, read its exact profile ID, and assert only the error or performance limits that represent stable product behavior.
    </x-docs.page-header>

    <x-docs.flow :steps="$diagram1" caption="A profile assertion complements the application test; it does not replace the response assertion." />

    <x-docs.section id="enable" title="Enable profiling before the test app boots">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The New Debug Bar defaults to the <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">local</code> environment. To capture profiles during tests, publish the package configuration and include <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">testing</code> in the allowed environments:</p>

        <x-docs.copyable-code
            class="mt-5"
            code="'environments' => ['local', 'testing'],"
            copy-label="Copy testing environment configuration"
            copy-success="Testing configuration copied"
        />

        <x-docs.callout class="mt-6" title="Enable it only for suites that use profiles:">
            profiling adds collection work and may inject the local bar into eligible HTML responses. Keep ordinary response tests separate when they do not need request-profile evidence.
        </x-docs.callout>
    </x-docs.section>

    <x-docs.section id="profile-id" title="Read the exact profile ID from the response">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Every profiled response includes <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">X-NewDebugBar-Profile</code>. Assert that the header exists, then pass its UUID to <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">ProfileAssertions::stored()</code>.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">Do not use “the latest profile” in a test. Related requests and background work can produce another profile after the response you meant to inspect.</p>
    </x-docs.section>

    <x-docs.section id="assertions" title="Use focused profile assertions">
        <div class="mt-6 overflow-x-auto rounded-xl border border-zinc-200 dark:border-white/10">
            <table class="w-full min-w-[44rem] text-left text-sm">
                <thead class="bg-zinc-50 text-zinc-950 dark:bg-white/[0.035] dark:text-white">
                    <tr><th class="px-4 py-3 font-semibold" scope="col">Assertion</th><th class="px-4 py-3 font-semibold" scope="col">Protects</th></tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 text-zinc-600 dark:divide-white/10 dark:text-zinc-400">
                    <tr><td class="px-4 py-3"><code class="font-mono text-[0.9em]">assertNoErrors()</code></td><td class="px-4 py-3">No error response or exception finding</td></tr>
                    <tr><td class="px-4 py-3"><code class="font-mono text-[0.9em]">assertNoRepeatedQueries()</code></td><td class="px-4 py-3">No repeated normalized query pattern</td></tr>
                    <tr><td class="px-4 py-3"><code class="font-mono text-[0.9em]">assertNoLikelyNPlusOneQueries()</code></td><td class="px-4 py-3">No likely N+1 finding</td></tr>
                    <tr><td class="px-4 py-3"><code class="font-mono text-[0.9em]">assertQueryCountAtMost($count)</code></td><td class="px-4 py-3">Maximum query count</td></tr>
                    <tr><td class="px-4 py-3"><code class="font-mono text-[0.9em]">assertQueryTimeAtMost($milliseconds)</code></td><td class="px-4 py-3">Maximum total query time</td></tr>
                    <tr><td class="px-4 py-3"><code class="font-mono text-[0.9em]">assertDurationAtMost($milliseconds)</code></td><td class="px-4 py-3">Maximum full request duration</td></tr>
                    <tr><td class="px-4 py-3"><code class="font-mono text-[0.9em]">assertPeakMemoryAtMost($megabytes)</code></td><td class="px-4 py-3">Maximum peak memory</td></tr>
                </tbody>
            </table>
        </div>
    </x-docs.section>

    <x-docs.section id="example" title="Write a Pest profile test">
        <x-docs.copyable-code
            class="mt-5"
            :code="$profileTest"
            copy-label="Copy Pest profile test"
            copy-success="Pest profile test copied"
            :multiline="true"
        />
    </x-docs.section>

    <x-docs.section id="budgets" title="Choose budgets that describe stable behavior">
        <ul class="mt-5 space-y-3" role="list">
            <x-docs.check-item>Prefer query counts and error findings when they are stable across machines.</x-docs.check-item>
            <x-docs.check-item>Give timing and memory budgets room for normal CI variation.</x-docs.check-item>
            <x-docs.check-item>Use realistic database records so a likely N+1 pattern can actually appear.</x-docs.check-item>
            <x-docs.check-item>Assert the response behavior separately; a healthy profile does not replace feature assertions.</x-docs.check-item>
        </ul>
    </x-docs.section>

    <x-docs.section id="complete-example" title="Run a small profile assertion without extra models">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">After enabling profiling for the testing environment as described above, this Pest test defines its own simple JSON route. It needs a working database connection, but no additional table or model:</p>

        <x-docs.copyable-code class="mt-5" :code="$example2" copy-label="Copy complete profile test" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">For your application route, replace the example route and use the fixture data that makes the behavior meaningful. The <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.queries') }}">N+1 walkthrough</a> needs several parent records so repeated relationship reads can appear.</p>
    </x-docs.section>

    <x-docs.section id="supplied-profile" title="Assert a supplied profile when you already have it">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Use <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">ProfileAssertions::for($profile)</code> when your test already owns the captured profile array. Use <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">stored($id)</code> when the response ID is your source of truth. Both apply the package’s presentation and analysis to the profile.</p>

        <x-docs.copyable-code class="mt-5" :code="$example3" copy-label="Copy supplied-profile assertions" copy-success="Example copied" :multiline="true" />
    </x-docs.section>

    <x-docs.section id="missing-header" title="If the test response has no profile header">
        <ul class="mt-5 space-y-3" role="list">
            <x-docs.check-item>Confirm the package is enabled and testing is in the allowed environments before the application boots.</x-docs.check-item>
            <x-docs.check-item>Check for a disabled environment variable or cached configuration used by the test process.</x-docs.check-item>
            <x-docs.check-item>Make the intended application request; the package’s own routes are excluded.</x-docs.check-item>
            <x-docs.check-item>Keep the exact response ID when tests or workers create several profiles.</x-docs.check-item>
        </ul>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Test command profiles are different from HTTP response assertions. See <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.artisan') }}">Artisan commands</a> for their command-level scope.</p>
    </x-docs.section>

    <x-docs.next-step
        :href="route('docs.mcp')"
        title="Inspect a failing profile with an agent"
        description="Pass the exact response-header profile ID to the local MCP server for bounded findings and deeper retained evidence."
        link-label="Open the MCP setup guide"
    />
</x-layouts.docs>
