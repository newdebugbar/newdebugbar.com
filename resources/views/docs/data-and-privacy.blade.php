@php
    $diagram1 = [['title' => 'Capture', 'description' => 'Retain useful local evidence within configured bounds and value policies.'], ['title' => 'Store', 'description' => 'Write short-lived profiles into the app’s private runtime directory.'], ['title' => 'Inspect', 'description' => 'The browser and MCP read what remains in that profile.']];

@endphp

<x-layouts.docs
    meta-title="Data storage and privacy in The New Debug Bar"
    description="Understand which local Laravel debug data The New Debug Bar captures, where profiles are stored, how retention and limits work, and how to mask bindings or hash keys."
    :canonical="url('/docs/data-and-privacy')"
    og-title="Data and privacy in The New Debug Bar"
    og-description="Local profile storage, short retention, bounded collection, query binding policies, key policies, browser access, and MCP access."
    page-title="Data and privacy"
    :sections="[
        ['id' => 'local-only', 'label' => 'Local-only operation'],
        ['id' => 'captured', 'label' => 'What is captured'],
        ['id' => 'storage', 'label' => 'Storage and retention'],
        ['id' => 'limits', 'label' => 'Collection limits'],
        ['id' => 'policies', 'label' => 'Value policies'],
        ['id' => 'access', 'label' => 'Browser and MCP access'],
        ['id' => 'retained-evidence', 'label' => 'What is retained, summarized, or live-only?'],
        ['id' => 'limits-and-pages', 'label' => 'Capture limits and response limits are different'],
        ['id' => 'client-context', 'label' => 'Know which tool handles the model context'],
    ]"
>
    <x-docs.page-header category="Reference" title="Know what stays in a local debug profile">
        The New Debug Bar keeps short-lived request evidence on your machine. Exact values are useful for debugging, so choose stricter capture policies when the development environment is shared or uses sensitive data.
    </x-docs.page-header>

    <x-docs.flow :steps="$diagram1" caption="Changing a policy later does not rewrite the evidence that was already captured." />

    <x-docs.section id="local-only" title="The package runs only in allowed environments">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The default allowed environment is <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">local</code>. When the package is disabled or the current Laravel environment is not allowed, profiling, package routes, the browser interface, and the MCP server stay inactive.</p>

        <x-docs.callout class="mt-6" tone="notice" title="Do not treat an environment name as access control">
            Keep The New Debug Bar in <code class="font-mono text-[0.9em] text-violet-950 dark:text-violet-100">require-dev</code> and skip development dependencies in production. If a shared environment needs the package, protect that environment separately and choose stricter value policies.
        </x-docs.callout>
    </x-docs.section>

    <x-docs.section id="captured" title="Profiles contain debugging evidence">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">A profile can contain request details, route and user context, query SQL and bindings, model identifiers and changes, cache and Redis keys, log context, exception frames and source context, validation messages, view data, mail previews, notification payloads, HTTP metadata, and other values produced during the request.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">The exact inspectors depend on what happened. The New Debug Bar does not invent missing evidence, and it does not need every inspector to be populated for a profile to be useful.</p>
    </x-docs.section>

    <x-docs.section id="storage" title="Profiles use private short-lived files">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The default directory is <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">storage/framework/newdebugbar</code>. Profile files are written atomically with private file permissions, and the generated directory ignores its contents so normal local use does not dirty the repository.</p>

        <ul class="mt-5 space-y-3" role="list">
            <x-docs.check-item>The latest 20 profiles are retained by default.</x-docs.check-item>
            <x-docs.check-item>Profiles older than 60 minutes expire by default.</x-docs.check-item>
            <x-docs.check-item>Pruning happens as new profiles are stored and expired profiles are read.</x-docs.check-item>
            <x-docs.check-item>A custom path should remain private and outside version control.</x-docs.check-item>
        </ul>
    </x-docs.section>

    <x-docs.section id="limits" title="Collection is bounded before storage">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The package limits records, nested arrays, depth, string length, mail bodies, attachment bodies, call-site frames, exception evidence, and findings. Large inspectors may report that data was dropped or truncated instead of growing without a bound.</p>

        <x-docs.callout class="mt-6" title="Bounds are part of the evidence:">
            when a inspector reports omitted items, do not read the retained sample as a complete count. Increase the relevant limit only when the missing detail is needed for the local investigation.
        </x-docs.callout>
    </x-docs.section>

    <x-docs.section id="policies" title="Set value policies before capture">
        <div class="mt-6 overflow-x-auto rounded-xl border border-zinc-200 dark:border-white/10">
            <table class="w-full min-w-[42rem] text-left text-sm">
                <thead class="bg-zinc-50 text-zinc-950 dark:bg-white/[0.035] dark:text-white">
                    <tr>
                        <th class="px-4 py-3 font-semibold" scope="col">Policy</th>
                        <th class="px-4 py-3 font-semibold" scope="col">Values</th>
                        <th class="px-4 py-3 font-semibold" scope="col">Use it when</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 text-zinc-600 dark:divide-white/10 dark:text-zinc-400">
                    <tr><td class="px-4 py-3"><code class="font-mono text-[0.9em]">query_bindings: full</code></td><td class="px-4 py-3">Exact bounded bindings</td><td class="px-4 py-3">Normal private local debugging</td></tr>
                    <tr><td class="px-4 py-3"><code class="font-mono text-[0.9em]">query_bindings: safe</code></td><td class="px-4 py-3">String bindings masked</td><td class="px-4 py-3">Query shape matters more than string values</td></tr>
                    <tr><td class="px-4 py-3"><code class="font-mono text-[0.9em]">query_bindings: none</code></td><td class="px-4 py-3">Bindings omitted</td><td class="px-4 py-3">No binding values should be retained</td></tr>
                    <tr><td class="px-4 py-3"><code class="font-mono text-[0.9em]">key_policy: hash</code></td><td class="px-4 py-3">Stable key hashes</td><td class="px-4 py-3">Matching operations is enough without exact keys</td></tr>
                </tbody>
            </table>
        </div>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">Policies apply at capture time. The browser and MCP server read the same retained profile, so neither can recover a value that was masked or omitted.</p>
    </x-docs.section>

    <x-docs.section id="access" title="The browser and MCP read local profiles">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The injected browser interface requests one selected profile and one inspector inspector at a time. The local MCP server exposes read-only tools with item and byte limits, and its generic data tool follows bounded paths into retained profile values.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">An MCP client must be able to start the Laravel app’s local Artisan command. The New Debug Bar does not upload profiles to a hosted service.</p>
    </x-docs.section>

    <x-docs.section id="retained-evidence" title="What is retained, summarized, or live-only?">
        <div class="mt-6 overflow-x-auto rounded-xl border border-zinc-200 dark:border-white/10">
            <table class="w-full min-w-[34rem] text-left text-sm">
                <thead class="bg-zinc-50 text-zinc-950 dark:bg-white/[0.035]">
                    <tr>
                        <th class="px-4 py-3 font-semibold" scope="col">Evidence</th>
                        <th class="px-4 py-3 font-semibold" scope="col">What to expect</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 text-zinc-600 dark:divide-white/10 dark:text-zinc-400">
                    <tr>
                        <td class="px-4 py-3 align-top">SQL bindings and cache or Redis keys</td>
                        <td class="px-4 py-3 align-top">Exact bounded values by default, with the documented alternative policies.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">HTTP headers and text or JSON bodies</td>
                        <td class="px-4 py-3 align-top">Bounded retained content with common credential fields and sensitive keys redacted. Multipart and binary bodies are omitted.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Event payloads</td>
                        <td class="px-4 py-3 align-top">Types, public field names, counts, and shape rather than raw event payload values.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Direct Redis commands</td>
                        <td class="px-4 py-3 align-top">Command, recognized keys, connection, timing, failure state, source, and available exception class. No arbitrary arguments or returned values.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">View data</td>
                        <td class="px-4 py-3 align-top">Bounded retained values. Renderable objects and lazy component methods may be represented by class labels rather than being executed.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Command input</td>
                        <td class="px-4 py-3 align-top">Argument and option names rather than their values or a full terminal transcript.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Livewire</td>
                        <td class="px-4 py-3 align-top">Saved server metadata and activity, plus separate live browser state and browser-only traces while the page exists.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">EXPLAIN</td>
                        <td class="px-4 py-3 align-top">An explicit current database action in the browser; do not assume its result was saved in the original profile.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </x-docs.section>

    <x-docs.section id="limits-and-pages" title="Capture limits and response limits are different">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">A capture limit decides which values reach storage. An MCP response limit decides how much retained evidence fits in one reply. Follow a returned path or cursor to read the next part; capture again if the needed value was omitted before storage.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">See <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.configuration') }}">Configuration</a> for all limits and <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.troubleshooting.missing-profiles') }}">Find missing profiles and data</a> for a decision path.</p>
    </x-docs.section>

    <x-docs.section id="client-context" title="Know which tool handles the model context">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The package stores profiles locally and exposes the local MCP command. Your coding client decides what tool results it sends to its model provider. The New Debug Bar does not manage that client’s conversation or provider settings.</p>
    </x-docs.section>

    <x-docs.next-step
        :href="route('docs.configuration')"
        title="Choose your capture settings"
        description="Publish the configuration only when you need different retention, limits, environments, bindings, or key behavior."
        link-label="Open configuration"
    />
</x-layouts.docs>
