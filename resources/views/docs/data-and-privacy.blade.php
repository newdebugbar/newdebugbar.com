<x-layouts.docs
    meta-title="New Debug Bar data storage and privacy"
    description="Understand which local Laravel debug data New Debug Bar captures, where profiles are stored, how retention and limits work, and how to mask bindings or hash keys."
    :canonical="url('/docs/data-and-privacy')"
    og-title="New Debug Bar data and privacy"
    og-description="Local profile storage, short retention, bounded collection, query binding policies, key policies, browser access, and MCP access."
    page-title="Data and privacy"
    :sections="[
        ['id' => 'local-only', 'label' => 'Local-only operation'],
        ['id' => 'captured', 'label' => 'What is captured'],
        ['id' => 'storage', 'label' => 'Storage and retention'],
        ['id' => 'limits', 'label' => 'Collection limits'],
        ['id' => 'policies', 'label' => 'Value policies'],
        ['id' => 'access', 'label' => 'Browser and MCP access'],
    ]"
>
    <x-docs.page-header category="Reference" title="Know what stays in a local debug profile">
        New Debug Bar keeps short-lived request evidence on your machine. Exact values are useful for debugging, so choose stricter capture policies when the development environment is shared or uses sensitive data.
    </x-docs.page-header>

    <x-docs.section id="local-only" title="The package runs only in allowed environments">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The default allowed environment is <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">local</code>. When the package is disabled or the current Laravel environment is not allowed, profiling, package routes, the browser interface, and the MCP server stay inactive.</p>

        <x-docs.callout class="mt-6" tone="notice" title="Do not treat an environment name as access control">
            Keep New Debug Bar in <code class="font-mono text-[0.9em] text-violet-950 dark:text-violet-100">require-dev</code> and skip development dependencies in production. If a shared environment needs the package, protect that environment separately and choose stricter value policies.
        </x-docs.callout>
    </x-docs.section>

    <x-docs.section id="captured" title="Profiles contain debugging evidence">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">A profile can contain request details, route and user context, query SQL and bindings, model identifiers and changes, cache and Redis keys, log context, exception frames and source context, validation messages, view data, mail previews, notification payloads, HTTP metadata, and other values produced during the request.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">The exact sections depend on what happened. New Debug Bar does not invent missing evidence, and it does not need every section to be populated for a profile to be useful.</p>
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
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The package limits records, nested arrays, depth, string length, mail bodies, attachment bodies, call-site frames, exception evidence, and findings. Large sections may report that data was dropped or truncated instead of growing without a bound.</p>

        <x-docs.callout class="mt-6" title="Bounds are part of the evidence:">
            when a section reports omitted items, do not read the retained sample as a complete count. Increase the relevant limit only when the missing detail is needed for the local investigation.
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
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The injected browser interface requests one selected profile and one inspector section at a time. The local MCP server exposes read-only tools with item and byte limits, and its generic data tool follows bounded paths into retained profile values.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">An MCP client must be able to start the Laravel app’s local Artisan command. New Debug Bar does not upload profiles to a hosted New Debug Bar service.</p>
    </x-docs.section>

    <x-docs.next-step
        :href="route('docs.configuration')"
        title="Choose your capture settings"
        description="Publish the configuration only when you need different retention, limits, environments, bindings, or key behavior."
        link-label="Open configuration"
    />
</x-layouts.docs>
