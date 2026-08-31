@php
    $inspectors = [
        ['name' => 'Request', 'description' => 'Select the request profile and review method, path, route, status, user, context, duration, and related activity.'],
        ['name' => 'Timeline', 'description' => 'Follow important captured work in execution order across queries, HTTP calls, rendering, events, models, and other sections.'],
        ['name' => 'Queries', 'description' => 'Inspect SQL, bindings, duration, connection, repeated patterns, likely N+1 leads, call sites, and supported EXPLAIN plans.'],
        ['name' => 'Models', 'description' => 'Review Eloquent retrievals and writes, model identifiers, changed attributes, repeated records, sources, timings, and related queries.'],
        ['name' => 'Views', 'description' => 'See rendered Blade templates, source files, bounded data, render order, repeated partials, and missing or unexpected values.'],
        ['name' => 'Livewire', 'description' => 'Inspect Livewire 4 component instances, parentage, properties, source, views, lifecycle activity, effects, and failures.'],
        ['name' => 'Exceptions', 'description' => 'Inspect reported exceptions, retained causes, application and vendor frames, source context, and the code path that failed.'],
        ['name' => 'Logs', 'description' => 'Review log levels, messages, bounded context, channel information, and the application source that wrote each entry.'],
        ['name' => 'HTTP client', 'description' => 'Review outbound Laravel HTTP requests and responses, method, URL, status, timing, failure details, and source.'],
        ['name' => 'Queue', 'description' => 'See dispatched jobs, connection and queue, delay and dispatch facts, payload context, source, and related worker activity when available.'],
        ['name' => 'Mail', 'description' => 'Inspect created mail, recipients, subject, headers, HTML and text previews, attachments, and application source within configured limits.'],
        ['name' => 'Notifications', 'description' => 'Inspect notification recipients, channels, payloads, delivery results or failures, timing, and source code.'],
        ['name' => 'Cache', 'description' => 'Review Laravel cache reads, writes, deletes, stores, keys or hashes, hits and misses, timing, tags, and source.'],
        ['name' => 'Redis', 'description' => 'Inspect direct Redis commands, connections, keys or hashes, parameters, timing, results, and application call sites.'],
        ['name' => 'Events', 'description' => 'See dispatched Laravel events, listener handling evidence, payload context, timing, and where dispatch happened.'],
        ['name' => 'Authorization', 'description' => 'Review Gate and policy decisions, ability, result, user and arguments, source, and the policy or callback involved.'],
        ['name' => 'Validation', 'description' => 'Review failed fields, messages, rules, submitted context, source, and component information for handled validation failures.'],
    ];
@endphp

<x-layouts.docs
    meta-title="Inspector sections in the New Debug Bar"
    description="See what every inspector in the New Debug Bar captures for Laravel requests, queries, models, views, Livewire, errors, logs, HTTP, queues, mail, cache, Redis, and more."
    :canonical="url('/docs/inspectors')"
    og-title="Inspector sections in the New Debug Bar"
    og-description="A complete reference for the focused evidence available in each Laravel debug profile section."
    page-title="Inspector sections"
    :sections="[
        ['id' => 'how-to-use', 'label' => 'How to use sections'],
        ['id' => 'all-sections', 'label' => 'All sections'],
        ['id' => 'empty-sections', 'label' => 'Empty sections'],
        ['id' => 'mcp-parity', 'label' => 'MCP access'],
    ]"
>
    <x-docs.page-header category="Reference" title="Choose the inspector that answers your next question">
        Each section keeps one kind of evidence focused. Start with the request overview or a finding, then open the smallest section that can explain the symptom.
    </x-docs.page-header>

    <x-docs.section id="how-to-use" title="Move from symptom to source">
        <ol class="mt-6 space-y-6" role="list">
            <x-docs.step number="1" title="Confirm the request profile">
                Match its method, path, status, type, and time before interpreting the inspector data.
            </x-docs.step>
            <x-docs.step number="2" title="Use the overview or a finding">
                Let the visible symptom choose the first section instead of opening every tab.
            </x-docs.step>
            <x-docs.step number="3" title="Follow application evidence">
                Open source locations, call stacks, related records, and ordered activity until you reach code that controls the behavior.
            </x-docs.step>
            <x-docs.step number="4" title="Repeat the request">
                Verify the change on the same path and check that related behavior still works.
            </x-docs.step>
        </ol>
    </x-docs.section>

    <x-docs.section id="all-sections" title="All inspector sections">
        <div class="mt-6 grid gap-4 sm:grid-cols-2">
            @foreach ($inspectors as $inspector)
                <article class="rounded-2xl border border-zinc-200 bg-zinc-50/60 p-5 dark:border-white/10 dark:bg-white/[0.025]">
                    <h3 class="font-semibold text-zinc-950 dark:text-white">{{ $inspector['name'] }}</h3>
                    <p class="mt-2 text-sm leading-6 text-zinc-600 dark:text-zinc-400">{{ $inspector['description'] }}</p>
                </article>
            @endforeach
        </div>
    </x-docs.section>

    <x-docs.section id="empty-sections" title="An empty section can be correct">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">A request that sent no mail should have no mail records. A page that made no direct Redis commands may still use Laravel’s cache abstraction and populate Cache instead. The absence of rows means the New Debug Bar retained no matching activity for that selected profile.</p>

        <x-docs.callout class="mt-6" title="Check truncation separately:">
            an empty section and a bounded section are different. When collection limits drop records, the section reports retained and omitted counts so you know the sample is incomplete.
        </x-docs.callout>
    </x-docs.section>

    <x-docs.section id="mcp-parity" title="Agents can reach the same retained evidence">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The local MCP server exposes every retained profile section through bounded requests. Focused tools summarize common work, while <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">get-debug-profile-data</code> follows returned JSON Pointer paths into deeper evidence.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">Capture-time masking, hashing, truncation, and retention apply equally to the browser inspector and MCP. The agent cannot read a value that the stored profile does not retain.</p>
    </x-docs.section>

    <x-docs.next-step
        :href="route('docs.mcp')"
        title="Give an agent the same inspector data"
        description="Connect the local read-only MCP server and use exact profile IDs to keep agent analysis on the right request."
        link-label="Open the MCP setup guide"
    />
</x-layouts.docs>
