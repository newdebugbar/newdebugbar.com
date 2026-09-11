@php
    $example1 = <<<'EXAMPLE1'
Event::listen(
    TripWorkspaceRefreshed::class,
    RecordWorkspaceRefresh::class,
);
EXAMPLE1;

    $example2 = <<<'EXAMPLE2'
php artisan event:list
EXAMPLE2;

@endphp

<x-layouts.docs
    meta-title="Trace Laravel events and listeners | The New Debug Bar"
    description="Find dispatch sources, repeated Laravel events, listener registrations, duplicate listeners, and related queued activity."
    :canonical="url('/docs/events')"
    og-title="Trace Laravel events and listeners"
    og-description="Find dispatch sources, repeated Laravel events, listener registrations, duplicate listeners, and related queued activity."
    page-title="Events and listeners"
    :sections="[
        ['id' => 'dispatch', 'label' => 'Find the application event'],
        ['id' => 'duplicates', 'label' => 'Distinguish two common causes'],
        ['id' => 'handling', 'label' => 'Read listener evidence carefully'],
        ['id' => 'payload', 'label' => 'Use payload shape to check the contract'],
        ['id' => 'verify', 'label' => 'Verify one logical operation'],
    ]"
>
    <x-docs.page-header category="Framework activity" title="Trace Laravel events and listeners">
        When one action causes duplicate work, separate a repeated event dispatch from the same listener being registered more than once.
    </x-docs.page-header>

    <x-docs.screenshot name="events" alt="One event dispatch with a duplicate listener registration" caption="The benchmark dispatches TripWorkspaceRefreshed once but exposes two registrations for the same listener." />

    <x-docs.section id="dispatch" title="Find the application event">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Open Events for the originating request. Use the application filter and search for the event name. Check the occurrence count, dispatch source, sequence, and related framework activity.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">An event name alone does not show which part of the application dispatched it. Follow the retained source before changing a listener.</p>
    </x-docs.section>

    <x-docs.section id="duplicates" title="Distinguish two common causes">
        <div class="mt-6 overflow-x-auto rounded-xl border border-zinc-200 dark:border-white/10">
            <table class="w-full min-w-[34rem] text-left text-sm">
                <thead class="bg-zinc-50 text-zinc-950 dark:bg-white/[0.035]">
                    <tr>
                        <th class="px-4 py-3 font-semibold" scope="col">Evidence</th>
                        <th class="px-4 py-3 font-semibold" scope="col">Likely next check</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 text-zinc-600 dark:divide-white/10 dark:text-zinc-400">
                    <tr>
                        <td class="px-4 py-3 align-top">Several dispatches of the same event</td>
                        <td class="px-4 py-3 align-top">Inspect repeated controller calls, model hooks, component actions, or retries that dispatch it.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">One dispatch, duplicate listener registration</td>
                        <td class="px-4 py-3 align-top">Compare automatic discovery with explicit registration.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">One listener registration, repeated job attempts</td>
                        <td class="px-4 py-3 align-top">Open the queued worker profiles and compare attempts.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The benchmark has a discoverable listener and also registers it explicitly:</p>

        <x-docs.copyable-code class="mt-5" :code="$example1" copy-label="Copy explicit-listener example" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">If your application already discovers that same listener, keep one intended registration. Confirm the actual registration list before removing anything:</p>

        <x-docs.copyable-code class="mt-5" :code="$example2" copy-label="Copy listener check" copy-success="Example copied" :multiline="true" />
    </x-docs.section>

    <x-docs.section id="handling" title="Read listener evidence carefully">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The inspector shows registered listener metadata and the handling evidence available for the event. A registration explains who can handle it. An available completion marker describes observed handling; it does not prove an external recipient received a message or that later queued work completed.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">For queued listeners, follow <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.queues') }}">worker activity</a>. For an unexpected model write or duplicate message, open <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.eloquent') }}">Models</a> or <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.mail-and-notifications') }}">Mail and notifications</a> in the profile where it happened.</p>
    </x-docs.section>

    <x-docs.section id="payload" title="Use payload shape to check the contract">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Event evidence retains argument types, public field names, counts, and truncation state rather than raw payload values. This helps identify the event contract without evaluating an object graph.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">If the problem depends on a value that was not retained, inspect the relevant application code or add a focused Laravel log entry with the context you need. Do not expect MCP to recover an omitted value.</p>
    </x-docs.section>

    <x-docs.section id="verify" title="Verify one logical operation">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">After correcting a duplicate registration, repeat the same action. Confirm one expected registration and the intended number of side effects. If the app uses a cached event manifest, refresh that manifest through the app’s normal workflow; <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">php artisan event:clear</code> removes a stale local event cache.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Keep separate tests for the caller dispatching the event and the listener’s behavior. <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">Event::fake()</code> is useful for the caller test, but a fake does not prove that a real listener ran.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Read <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="https://laravel.com/framework/docs/13.x/events">Laravel’s event documentation</a> for discovery and registration rules in your framework version.</p>
    </x-docs.section>

    <x-docs.next-step
        :href="route('docs.queues')"
        title="Follow work sent to a queue"
        description="A queued listener may finish in a different process and profile."
        link-label="Read the guide"
    />
</x-layouts.docs>
