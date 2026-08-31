<x-layouts.docs
    meta-title="Debug Livewire 4 with the New Debug Bar"
    description="Inspect Livewire 4 page renders and update requests, component identity, properties, lifecycle activity, validation, queries, views, and events."
    :canonical="url('/docs/livewire')"
    og-title="Debug Livewire 4 requests and components"
    og-description="Connect each Livewire browser action to its server request, component activity, validation, queries, views, and source code."
    page-title="Livewire"
    :sections="[
        ['id' => 'compatibility', 'label' => 'Compatibility'],
        ['id' => 'request', 'label' => 'Choose the update'],
        ['id' => 'components', 'label' => 'Inspect components'],
        ['id' => 'activity', 'label' => 'Follow activity'],
        ['id' => 'validation', 'label' => 'Validation failures'],
    ]"
>
    <x-docs.page-header category="Laravel ecosystem" title="Connect a Livewire action to its server work">
        Select the update request created by the browser action, then inspect the component instances, lifecycle activity, validation, queries, views, and events captured for it.
    </x-docs.page-header>

    <x-docs.section id="compatibility" title="Livewire compatibility">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The New Debug Bar uses Livewire 4 for its own interface and can inspect host applications that use Livewire 4. Your Laravel app does not need to use Livewire, but an app that still depends on Livewire 3 cannot install the package.</p>

        <x-docs.callout class="mt-6" title="The New Debug Bar ignores its own Livewire traffic:">
            toolbar updates and package assets are excluded so the inspector does not fill itself with internal profiles.
        </x-docs.callout>
    </x-docs.section>

    <x-docs.section id="request" title="Choose the update request">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">A first page render and each later Livewire update are separate server requests. Perform one browser action, open the request picker, and select the new Livewire profile instead of staying on the original page profile.</p>

        <ul class="mt-5 space-y-3" role="list">
            <x-docs.check-item>Match the request time to the click, input, submit, poll, or event you just triggered.</x-docs.check-item>
            <x-docs.check-item>Use the exact <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">X-NewDebugBar-Profile</code> response header when similar updates are close together.</x-docs.check-item>
            <x-docs.check-item>Reselect the update after related activity appears; the active profile should stay the action you are debugging.</x-docs.check-item>
        </ul>
    </x-docs.section>

    <x-docs.section id="components" title="Inspect component identity and state shape">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The Livewire section lists component instances by name, class, source, view, ID, and parent relationship. It also describes public properties without storing the framework’s full component snapshot.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">Use instance identity and parentage when the same component appears more than once or a nested child behaves differently. Open the source attached to that instance instead of searching by component name alone.</p>
    </x-docs.section>

    <x-docs.section id="activity" title="Follow component activity in order">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The New Debug Bar records bounded host-component activity such as mounting, hydration, property updates, method calls, rendering, dispatches, redirects, streams, downloads, and failures when Livewire exposes that lifecycle evidence.</p>

        <ol class="mt-6 space-y-6" role="list">
            <x-docs.step number="1" title="Find the component instance">
                Confirm its class, source, view, and parent before following the activity rows tied to its ID.
            </x-docs.step>
            <x-docs.step number="2" title="Locate the user action">
                Look for the changed property or called method that corresponds to the browser interaction.
            </x-docs.step>
            <x-docs.step number="3" title="Open related framework evidence">
                Check Queries, Views, Events, Models, Logs, or Exceptions for the same update profile.
            </x-docs.step>
            <x-docs.step number="4" title="Repeat only that action">
                Verify a fix against the same update rather than comparing it with the full page render.
            </x-docs.step>
        </ol>
    </x-docs.section>

    <x-docs.section id="validation" title="Trace validation failures">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Handled validation failures can return a normal Livewire response, so an HTTP status alone may not explain why the interface did not advance. Open Validation for failed fields, messages, rules, and source, then connect the entry to the component activity that triggered it.</p>

        <x-docs.callout class="mt-6" title="Keep validation and exceptions separate:">
            expected validation feedback belongs in Validation. A thrown or reported failure belongs in Exceptions, even when both occur during a Livewire update.
        </x-docs.callout>
    </x-docs.section>

    <x-docs.next-step
        :href="route('docs.requests')"
        title="Manage related request profiles"
        description="Learn how to keep a page render, Livewire update, and later background activity separate while you debug."
        link-label="Open the requests guide"
    />
</x-layouts.docs>
