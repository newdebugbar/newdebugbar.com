@php
    $inspectors = [
        ['name' => 'Requests', 'description' => 'Select the request profile and review method, path, route, status, user, context, duration, and related activity.'],
        ['name' => 'Timeline', 'description' => 'Follow important captured work in execution order across queries, HTTP calls, rendering, events, models, and other inspectors.'],
        ['name' => 'Queries', 'description' => 'Inspect SQL, bindings, duration, connection, repeated patterns, likely N+1 leads, call sites, and supported EXPLAIN plans.'],
        ['name' => 'Models', 'description' => 'Review Eloquent retrievals and writes, model identifiers, changed attributes, repeated records, sources, timings, and related queries.'],
        ['name' => 'Views', 'description' => 'See rendered Blade templates, source files, bounded data, render order, repeated partials, and missing or unexpected values.'],
        ['name' => 'Livewire', 'description' => 'Inspect Livewire 4 component instances, parentage, properties, source, views, lifecycle activity, effects, and failures.'],
        ['name' => 'Exceptions', 'description' => 'Inspect reported exceptions, retained causes, application and vendor frames, source context, and the code path that failed.'],
        ['name' => 'Logs', 'description' => 'Review log levels, messages, bounded context, channel information, and the application source that wrote each entry.'],
        ['name' => 'HTTP Client', 'description' => 'Review outbound Laravel HTTP requests and responses, method, URL, status, timing, failure details, and source.'],
        ['name' => 'Queue', 'description' => 'See dispatched jobs, connection and queue, delay and dispatch facts, payload context, source, and related worker activity when available.'],
        ['name' => 'Mail', 'description' => 'Inspect created mail, recipients, subject, headers, HTML and text previews, attachments, and application source within configured limits.'],
        ['name' => 'Notifications', 'description' => 'Inspect notification recipients, channels, payloads, delivery results or failures, timing, and source code.'],
        ['name' => 'Cache', 'description' => 'Review Laravel cache reads, writes, deletes, stores, keys or hashes, hits and misses, timing, tags, and source.'],
        ['name' => 'Redis', 'description' => 'Inspect direct Redis commands, connections, recognized keys or hashes, timing, failure state, and application call sites.'],
        ['name' => 'Events', 'description' => 'See dispatched Laravel events, listener handling evidence, payload context, timing, and where dispatch happened.'],
        ['name' => 'Authorization', 'description' => 'Review Gate and policy decisions, ability, result, user and arguments, source, and the policy or callback involved.'],
        ['name' => 'Validation', 'description' => 'Review failed fields, messages, rules, submitted context, source, and component information for handled validation failures.'],
    ];
@endphp

<x-layouts.docs
    meta-title="Inspectors in The New Debug Bar"
    description="See what every inspector in The New Debug Bar captures for Laravel requests, queries, models, views, Livewire, errors, logs, HTTP, queues, mail, cache, Redis, and more."
    :canonical="url('/docs/inspectors')"
    og-title="Inspectors in The New Debug Bar"
    og-description="A complete reference for the focused evidence available in each Laravel inspector."
    page-title="Inspectors"
    :sections="[
        ['id' => 'how-to-use', 'label' => 'How to use inspectors'],
        ['id' => 'all-inspectors', 'label' => 'All inspectors'],
        ['id' => 'empty-inspectors', 'label' => 'Empty inspectors'],
        ['id' => 'mcp-parity', 'label' => 'MCP access'],
        ['id' => 'guides', 'label' => 'Open a focused guide'],
        ['id' => 'outside-http', 'label' => 'Work outside a browser page'],
    ]"
>
    <x-docs.page-header category="Reference" title="Choose the inspector that answers your next question">
        Each inspector keeps one kind of evidence focused. Start with the request overview or a finding, then open the smallest inspector that can explain the symptom.
    </x-docs.page-header>

    <x-docs.screenshot name="requests" alt="The request inspector and navigation to captured framework evidence" caption="Choose the inspector that answers the current question, then follow its source or related evidence." />

    <x-docs.section id="how-to-use" title="Move from symptom to source">
        <ol class="mt-6 space-y-6" role="list">
            <x-docs.step number="1" title="Confirm the request profile">
                Match its method, path, status, type, and time before interpreting the inspector data.
            </x-docs.step>
            <x-docs.step number="2" title="Use the overview or a finding">
                Let the visible symptom choose the first inspector instead of opening every tab.
            </x-docs.step>
            <x-docs.step number="3" title="Follow application evidence">
                Open source locations, call stacks, related records, and ordered activity until you reach code that controls the behavior.
            </x-docs.step>
            <x-docs.step number="4" title="Repeat the request">
                Verify the change on the same path and check that related behavior still works.
            </x-docs.step>
        </ol>
    </x-docs.section>

    <x-docs.section id="all-inspectors" title="All inspectors">
        <div class="mt-6 grid gap-4 sm:grid-cols-2">
            @foreach ($inspectors as $inspector)
                <article class="rounded-2xl border border-zinc-200 bg-zinc-50/60 p-5 dark:border-white/10 dark:bg-white/[0.025]">
                    <h3 class="font-semibold text-zinc-950 dark:text-white">{{ $inspector['name'] }}</h3>
                    <p class="mt-2 text-sm leading-6 text-zinc-600 dark:text-zinc-400">{{ $inspector['description'] }}</p>
                </article>
            @endforeach
        </div>
    </x-docs.section>

    <x-docs.section id="empty-inspectors" title="An empty inspector can be correct">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">A request that sent no mail should have no mail records. A page that made no direct Redis commands may still use Laravel’s cache abstraction and populate Cache instead. The absence of rows means The New Debug Bar retained no matching activity for that selected profile.</p>

        <x-docs.callout class="mt-6" title="Check truncation separately:">
            an empty inspector and a bounded inspector are different. When collection limits drop records, the inspector reports retained and omitted counts so you know the sample is incomplete.
        </x-docs.callout>
    </x-docs.section>

    <x-docs.section id="mcp-parity" title="Agents can reach the same retained evidence">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The local MCP server exposes every inspector’s retained evidence through bounded requests. Focused tools summarize common work, while <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">get-debug-profile-data</code> follows returned JSON Pointer paths into deeper evidence.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">Capture-time masking, hashing, truncation, and retention apply equally to the browser inspector and MCP. The agent cannot read a value that the stored profile does not retain.</p>
    </x-docs.section>

    <x-docs.section id="guides" title="Open a focused guide">
        <div class="mt-6 overflow-x-auto rounded-xl border border-zinc-200 dark:border-white/10">
            <table class="w-full min-w-[34rem] text-left text-sm">
                <thead class="bg-zinc-50 text-zinc-950 dark:bg-white/[0.035] dark:text-white">
                    <tr>
                        <th class="px-4 py-3 font-semibold" scope="col">Question</th>
                        <th class="px-4 py-3 font-semibold" scope="col">Guide</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 text-zinc-600 dark:divide-white/10 dark:text-zinc-400">
                    <tr>
                        <td class="px-4 py-3 align-top">Which request or response am I looking at?</td>
                        <td class="px-4 py-3 align-top"><a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.requests') }}">Requests</a></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Why does SQL repeat or take too long?</td>
                        <td class="px-4 py-3 align-top"><a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.queries') }}">Queries</a></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Where did the request spend its time?</td>
                        <td class="px-4 py-3 align-top"><a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.performance') }}">Performance</a></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Which records were retrieved or changed?</td>
                        <td class="px-4 py-3 align-top"><a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.eloquent') }}">Eloquent</a></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Which template received the wrong data?</td>
                        <td class="px-4 py-3 align-top"><a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.views') }}">Blade views</a></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Which component action caused this work?</td>
                        <td class="px-4 py-3 align-top"><a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.livewire') }}">Livewire</a></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">What failed, and what was logged nearby?</td>
                        <td class="px-4 py-3 align-top"><a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.errors-and-logs') }}">Errors and logs</a></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Which remote call failed or waited?</td>
                        <td class="px-4 py-3 align-top"><a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.http-client') }}">HTTP client</a></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">What happened after dispatch?</td>
                        <td class="px-4 py-3 align-top"><a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.queues') }}">Queues</a></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Which message or channel was involved?</td>
                        <td class="px-4 py-3 align-top"><a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.mail-and-notifications') }}">Mail and notifications</a></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Did the correct key and store return a hit?</td>
                        <td class="px-4 py-3 align-top"><a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.cache-and-redis') }}">Cache and Redis</a></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Why did an event or listener run twice?</td>
                        <td class="px-4 py-3 align-top"><a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.events') }}">Events and listeners</a></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Why did a policy or Gate deny this action?</td>
                        <td class="px-4 py-3 align-top"><a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.authorization') }}">Authorization</a></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Which field or rule stopped submission?</td>
                        <td class="px-4 py-3 align-top"><a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.validation') }}">Validation</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </x-docs.section>

    <x-docs.section id="outside-http" title="Work outside a browser page">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Use <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.artisan') }}">Artisan commands</a> for command profiles and <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.queues') }}">Queues</a> for individual worker attempts. The <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.mcp-tools') }}">MCP reference</a> explains bounded access to retained inspectors and deeper profile values.</p>
    </x-docs.section>

    <x-docs.next-step
        :href="route('docs.mcp')"
        title="Give an agent the same inspector data"
        description="Connect the local read-only MCP server and use exact profile IDs to keep agent analysis on the right request."
        link-label="Open the MCP setup guide"
    />
</x-layouts.docs>
