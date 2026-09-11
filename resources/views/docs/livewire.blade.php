<x-layouts.docs
    meta-title="Debug Livewire 4 with The New Debug Bar"
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
        ['id' => 'property-editing', 'label' => 'Edit a supported live property'],
        ['id' => 'validation-example', 'label' => 'Follow an invalid update through recovery'],
        ['id' => 'live-and-saved', 'label' => 'Separate mounted state from saved evidence'],
    ]"
>
    <x-docs.page-header category="Laravel ecosystem" title="Connect a Livewire action to its server work">
        Select the update request created by the browser action, then inspect the component instances, lifecycle activity, validation, queries, views, and events captured for it.
    </x-docs.page-header>

    <x-docs.screenshot name="livewire" alt="Live properties and confirmed server values for the mounted Journey Preferences component" caption="The component view distinguishes editable values, confirmed server state, and locked properties." />

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
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The Livewire inspector lists component instances by name, class, source, view, ID, and parent relationship. It also describes public properties without storing the framework’s full component snapshot.</p>

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

    <x-docs.section id="property-editing" title="Edit a supported live property">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">On the benchmark’s Kyoto page, open Livewire, choose Components, and select JourneyPreferences. Its <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">travelerCount</code> starts at 2. Open the property’s edit control, change it to 3, and apply the edit.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Check the mounted form and the new update profile. The form should now show three travelers. The package uses the normal Livewire update path, so application hooks, validation, rendering, and other normal behavior can run.</p>

        <div class="mt-6 overflow-x-auto rounded-xl border border-zinc-200 dark:border-white/10">
            <table class="w-full min-w-[34rem] text-left text-sm">
                <thead class="bg-zinc-50 text-zinc-950 dark:bg-white/[0.035] dark:text-white">
                    <tr>
                        <th class="px-4 py-3 font-semibold" scope="col">Property state</th>
                        <th class="px-4 py-3 font-semibold" scope="col">What it means</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 text-zinc-600 dark:divide-white/10 dark:text-zinc-400">
                    <tr>
                        <td class="px-4 py-3 align-top">Editable primitive</td>
                        <td class="px-4 py-3 align-top">A supported string, number, boolean, or null value on a mounted component can be edited when its descriptor allows it.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Editable array leaf</td>
                        <td class="px-4 py-3 align-top">Only eligible primitive leaf values are editable. Expand the array and use the offered control.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Locked</td>
                        <td class="px-4 py-3 align-top">A locked property such as the example’s <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">tripId</code> is not editable.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Dirty or updating</td>
                        <td class="px-4 py-3 align-top">The browser value and confirmed server value are not yet the same, or an update is in progress.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Unmounted or unsupported</td>
                        <td class="px-4 py-3 align-top">Inspect the retained information; do not expect a live edit control.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <x-docs.callout class="mt-6" title="An edit can run application behavior">Treat a property edit like the corresponding interaction with the host application. It is not a private scratch value inside the debugger.</x-docs.callout>
    </x-docs.section>

    <x-docs.section id="validation-example" title="Follow an invalid update through recovery">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The benchmark validates <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">travelerCount</code> between 1 and 8 when preferences are submitted. Use 0 in its normal form, submit, and inspect the resulting Livewire profile. Then correct the value to 3 and submit again.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The first attempt should show the failed rule and component context in <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.validation') }}">Validation</a>. The valid attempt should let the component finish its action. Compare the same component and method rather than the original full page render.</p>
    </x-docs.section>

    <x-docs.section id="live-and-saved" title="Separate mounted state from saved evidence">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Components can show live browser state and the last confirmed server values while the component remains mounted. Server profiles retain bounded component metadata, descriptors, and supported server activity. Some browser traces exist only in the current page.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">MCP can read retained server activity through paths such as <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">/inspectors/livewire/payload/activity_records</code>. It cannot edit the mounted component or recreate browser-only state after navigation.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">If an edit is unavailable, confirm the instance is still mounted, the property type is supported, and the UI’s stated write restriction. Reopening a historical profile does not remount its component.</p>
    </x-docs.section>

    <x-docs.next-step
        :href="route('docs.requests')"
        title="Manage related request profiles"
        description="Learn how to keep a page render, Livewire update, and later background activity separate while you debug."
        link-label="Open the requests guide"
    />
</x-layouts.docs>
