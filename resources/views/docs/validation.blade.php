@php
    $example1 = <<<'EXAMPLE1'
$validated = $request->validateWithBag('traveler-details', [
    'passport_number' => ['required', 'string'],
    'contact_email' => ['required', 'email'],
]);
EXAMPLE1;

    $example2 = <<<'EXAMPLE2'
use function Pest\Laravel\post;

post('/travelers', [
    'passport_number' => '',
    'contact_email' => 'elise-at-example.test',
])->assertSessionHasErrors(
    ['passport_number', 'contact_email'],
    errorBag: 'traveler-details',
);
EXAMPLE2;

@endphp

<x-layouts.docs
    meta-title="Find why a form fails validation | The New Debug Bar"
    description="Inspect Laravel and Livewire validation failures, error bags, failed fields, messages, rules, source, and the selected response."
    :canonical="url('/docs/validation')"
    og-title="Find why a form fails validation"
    og-description="Inspect Laravel and Livewire validation failures, error bags, failed fields, messages, rules, source, and the selected response."
    page-title="Validation"
    :sections="[
        ['id' => 'attempt', 'label' => 'Choose the submission or update'],
        ['id' => 'example', 'label' => 'Try a normal Laravel form failure'],
        ['id' => 'responses', 'label' => 'Understand the response you received'],
        ['id' => 'livewire', 'label' => 'Connect a Livewire failure to the component'],
        ['id' => 'verify', 'label' => 'Test the failure and the valid path'],
    ]"
>
    <x-docs.page-header category="Framework activity" title="Find why a form fails validation">
        A form can stay on the same screen without an application crash. Read the failed fields and rules before treating the response as an exception.
    </x-docs.page-header>

    <x-docs.screenshot name="validation" alt="A handled validation attempt with two failed fields and its response status" caption="This handled benchmark failure records missing passport details and an invalid contact email while the page still returns 200." />

    <x-docs.section id="attempt" title="Choose the submission or update">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Submit the form once, then select that POST or Livewire update profile. The original page request does not contain the later validation attempt. Use its exact response ID when several updates happen close together.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Open Validation and read the error bag, failed field names, messages, rule names, and available application or component source. A status shown for the validation failure can differ from the final response status.</p>
    </x-docs.section>

    <x-docs.section id="example" title="Try a normal Laravel form failure">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">In an existing form action, validate the fields before saving. This example uses a named error bag:</p>

        <x-docs.copyable-code class="mt-5" :code="$example1" copy-label="Copy validation example" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Submit an empty passport number and <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">elise-at-example.test</code> as the email. The failed rules should be Required and Email. Correct the input and submit again; the valid submission should continue into the action.</p>

        <x-docs.callout class="mt-6" title="Keep the actual submitted request">A form and a JSON request can receive different responses to the same validation exception. Preserve the Accept header and input shape when you reproduce the case.</x-docs.callout>
    </x-docs.section>

    <x-docs.section id="responses" title="Understand the response you received">
        <div class="mt-6 overflow-x-auto rounded-xl border border-zinc-200 dark:border-white/10">
            <table class="w-full min-w-[34rem] text-left text-sm">
                <thead class="bg-zinc-50 text-zinc-950 dark:bg-white/[0.035] dark:text-white">
                    <tr>
                        <th class="px-4 py-3 font-semibold" scope="col">Flow</th>
                        <th class="px-4 py-3 font-semibold" scope="col">What to inspect</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 text-zinc-600 dark:divide-white/10 dark:text-zinc-400">
                    <tr>
                        <td class="px-4 py-3 align-top">A normal Laravel form</td>
                        <td class="px-4 py-3 align-top">The redirect and named session error bag, alongside the failed submission profile.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">A JSON request</td>
                        <td class="px-4 py-3 align-top">The validation response and its 422 status when Laravel handles the failure normally.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">A Livewire update</td>
                        <td class="px-4 py-3 align-top">The update profile and component validation evidence; the response can still be 200.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">A caught or custom-handled failure</td>
                        <td class="px-4 py-3 align-top">The evidence that was actually recorded and the app’s final response. Do not assume every caught exception is captured.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </x-docs.section>

    <x-docs.section id="livewire" title="Connect a Livewire failure to the component">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Open <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.livewire') }}">Livewire</a> for the same update. Match the component instance and the property update or method call that triggered validation. Then return to Validation to inspect the field, rule, and message.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The benchmark’s planning controls are page-local drafts. Setting an invalid traveler count and submitting exercises a handled component failure; correcting the count lets the same action finish.</p>
    </x-docs.section>

    <x-docs.section id="verify" title="Test the failure and the valid path">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">For your existing POST route, a test can assert the expected named bag:</p>

        <x-docs.copyable-code class="mt-5" :code="$example2" copy-label="Copy validation test" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Use your app’s real route and required setup, then add a valid-submission test that checks the intended change. A lack of error rows alone does not prove the form saved correctly.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Use <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.errors-and-logs') }}">Exceptions and Logs</a> for a separate thrown or reported failure. Framework details are in <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="https://laravel.com/framework/docs/13.x/validation">Laravel’s validation guide</a>.</p>
    </x-docs.section>
</x-layouts.docs>
