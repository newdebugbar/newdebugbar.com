@php
    $example1 = <<<'EXAMPLE1'
public function update(User $user, Trip $trip): bool
{
    return $trip->user_id === $user->id;
}
EXAMPLE1;

    $example2 = <<<'EXAMPLE2'
use Illuminate\Support\Facades\Gate;

$ownerDecision = Gate::forUser($owner)->inspect('update', $trip);
$otherDecision = Gate::forUser($otherUser)->inspect('update', $trip);

expect($ownerDecision->allowed())->toBeTrue();
expect($otherDecision->allowed())->toBeFalse();
EXAMPLE2;

@endphp

<x-layouts.docs
    meta-title="Debug Gates, policies, and denied requests | The New Debug Bar"
    description="Trace a Laravel authorization decision to its ability, user, arguments, policy or Gate handler, and application source."
    :canonical="url('/docs/authorization')"
    og-title="Debug Gates, policies, and denied requests"
    og-description="Trace a Laravel authorization decision to its ability, user, arguments, policy or Gate handler, and application source."
    page-title="Authorization"
    :sections="[
        ['id' => 'decision', 'label' => 'Find the decision behind the response'],
        ['id' => 'source', 'label' => 'Check the resolved policy or Gate'],
        ['id' => 'reproduce', 'label' => 'Compare the same ability with two users'],
        ['id' => 'blade', 'label' => 'Trace checks inside Blade'],
        ['id' => 'verify', 'label' => 'Verify allowed and denied behavior'],
    ]"
>
    <x-docs.page-header category="Framework activity" title="Debug Gates, policies, and denied requests">
        When a request is denied, inspect the decision in the context that produced it. The user, resource, and resolved handler matter as much as the result.
    </x-docs.page-header>

    <x-docs.screenshot name="authorization" alt="Allowed and denied policy decisions with user, resource, and policy source" caption="The Kyoto example records two allowed decisions and one denied refund decision for the same user and trip." />

    <x-docs.section id="decision" title="Find the decision behind the response">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Select the request that returned the unexpected result, then open Authorization. Filter to denied decisions if that matches the symptom. Open the ability you expected the action to check.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Read the evaluated user and arguments. A missing user, a different model instance, or the wrong guard can explain a result before you reach the policy method.</p>

        <x-docs.callout class="mt-6" title="An expected denial is healthy">The benchmark’s refund policy deliberately returns false. A denied finding is a lead to inspect, not an instruction to grant access.</x-docs.callout>
    </x-docs.section>

    <x-docs.section id="source" title="Check the resolved policy or Gate">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The detail shows the policy or Gate handler when it can be resolved, its application source, and available decision messages, codes, or custom response status. Open the policy method and compare its inputs with the captured user and resource.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">A policy like this allows the owner to update a trip:</p>

        <x-docs.copyable-code class="mt-5" :code="$example1" copy-label="Copy policy example" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Check ownership and the rule you intended to enforce. If the resolved method looks right but the result still differs, inspect Gate or policy before/after hooks. The inspector does not identify every hook that may affect the final decision.</p>
    </x-docs.section>

    <x-docs.section id="reproduce" title="Compare the same ability with two users">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">In an existing app with a Trip policy, load the owner and another fixture user, then check the same resource:</p>

        <x-docs.copyable-code class="mt-5" :code="$example2" copy-label="Copy policy assertions" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">These are test assertions for a rule that permits only the owner. Adapt the expected decisions to your actual policy. Then exercise the HTTP route separately: a policy check in a unit of code does not prove the route calls it.</p>
    </x-docs.section>

    <x-docs.section id="blade" title="Trace checks inside Blade">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Repeated <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">@@can</code> checks can come from a list or a shared component. Use the retained source to find the original Blade template when it is available. Confirm which resource each row passed to the ability before changing repeated checks.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Authorization and authentication answer different questions. Use <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.requests') }}">Requests</a> to check the matched route, guard, and authentication context.</p>
    </x-docs.section>

    <x-docs.section id="verify" title="Verify allowed and denied behavior">
        <ul class="mt-5 space-y-3" role="list">
            <x-docs.check-item>Repeat the failing action as the intended user and resource.</x-docs.check-item>
            <x-docs.check-item>Check the recorded decision and the real response, including any custom denial status.</x-docs.check-item>
            <x-docs.check-item>Add a focused route test for the allowed case and a denied case.</x-docs.check-item>
            <x-docs.check-item>Keep the denial when the policy correctly protects the action.</x-docs.check-item>
        </ul>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">See <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="https://laravel.com/framework/docs/13.x/authorization">Laravel’s authorization documentation</a> for the framework’s Gate and policy behavior.</p>
    </x-docs.section>

    <x-docs.next-step
        :href="route('docs.validation')"
        title="Inspect form validation"
        description="A handled validation failure can explain why a form never reaches the authorized action."
        link-label="Read the guide"
    />
</x-layouts.docs>
