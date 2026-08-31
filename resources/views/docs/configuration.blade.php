@php
    $storageConfig = <<<'PHP'
'storage' => [
    'path' => null,
    'max_profiles' => 20,
    'max_age_minutes' => 60,
],
PHP;
@endphp

<x-layouts.docs
    meta-title="Configure the New Debug Bar for Laravel"
    description="Configure environments, thresholds, profile storage, capture limits, query bindings, keys, and call-site evidence in the New Debug Bar."
    :canonical="url('/docs/configuration')"
    og-title="Configure the New Debug Bar"
    og-description="Use the defaults first, then tune the few settings that change profiling, retention, or captured evidence."
    page-title="Configuration"
    :sections="[
        ['id' => 'publish', 'label' => 'Publish the config'],
        ['id' => 'state', 'label' => 'State and theme'],
        ['id' => 'thresholds', 'label' => 'Thresholds'],
        ['id' => 'storage', 'label' => 'Profile storage'],
        ['id' => 'collection', 'label' => 'Collection limits'],
        ['id' => 'sensitive-values', 'label' => 'Sensitive values'],
    ]"
>
    <x-docs.page-header category="Getting started" title="Change only the defaults your app needs">
        The New Debug Bar works without a published file. Publish the configuration when your local environment, workload, or data policy needs a different runtime effect.
    </x-docs.page-header>

    <x-docs.section id="publish" title="Publish the configuration">
        <x-docs.copyable-code
            class="mt-5"
            code="php artisan vendor:publish --tag=newdebugbar-config"
            copy-label="Copy publish command"
            copy-success="Publish command copied"
            :prompt="true"
            :prominent="true"
        />

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">This creates <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">config/newdebugbar.php</code>. Read the comments beside each value before changing it. After editing cached configuration, run <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">php artisan config:clear</code>.</p>
    </x-docs.section>

    <x-docs.section id="state" title="Control package state and theme">
        <div class="mt-6 overflow-x-auto rounded-xl border border-zinc-200 dark:border-white/10">
            <table class="w-full min-w-[38rem] text-left text-sm">
                <thead class="bg-zinc-50 text-zinc-950 dark:bg-white/[0.035] dark:text-white">
                    <tr>
                        <th class="px-4 py-3 font-semibold" scope="col">Setting</th>
                        <th class="px-4 py-3 font-semibold" scope="col">Default</th>
                        <th class="px-4 py-3 font-semibold" scope="col">Change it when</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 text-zinc-600 dark:divide-white/10 dark:text-zinc-400">
                    <tr>
                        <td class="px-4 py-3"><code class="font-mono text-[0.9em] text-zinc-900 dark:text-zinc-200">enabled</code></td>
                        <td class="px-4 py-3"><code class="font-mono text-[0.9em]">true</code></td>
                        <td class="px-4 py-3">A local task needs profiling, routes, interface work, and MCP completely inactive.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3"><code class="font-mono text-[0.9em] text-zinc-900 dark:text-zinc-200">environments</code></td>
                        <td class="px-4 py-3"><code class="font-mono text-[0.9em]">['local']</code></td>
                        <td class="px-4 py-3">Your app uses another name for local development.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3"><code class="font-mono text-[0.9em] text-zinc-900 dark:text-zinc-200">theme</code></td>
                        <td class="px-4 py-3"><code class="font-mono text-[0.9em]">system</code></td>
                        <td class="px-4 py-3">You want the first visit to start in <code class="font-mono text-[0.9em]">light</code> or <code class="font-mono text-[0.9em]">dark</code> mode.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">Set <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">NEWDEBUGBAR_ENABLED=false</code> to disable the package without removing it. A theme chosen in the browser overrides the starting theme for that browser.</p>
    </x-docs.section>

    <x-docs.section id="thresholds" title="Tune findings to local work">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Thresholds decide when the New Debug Bar calls attention to captured work. They do not stop collection.</p>

        <ul class="mt-5 space-y-3" role="list">
            <x-docs.check-item><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">slow_query_ms</code> defaults to <code class="font-mono text-[0.9em]">100</code>.</x-docs.check-item>
            <x-docs.check-item><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">slow_http_request_ms</code> defaults to <code class="font-mono text-[0.9em]">250</code>.</x-docs.check-item>
            <x-docs.check-item><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">slow_request_ms</code> defaults to <code class="font-mono text-[0.9em]">1000</code>.</x-docs.check-item>
        </ul>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">Choose values that separate normal local noise from work you would investigate. Local timings are useful for comparison, not production latency promises.</p>
    </x-docs.section>

    <x-docs.section id="storage" title="Control profile storage">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Profiles stay in a private local runtime directory. By default, the package uses <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">storage/framework/newdebugbar</code>, keeps the latest 20 profiles, and removes profiles older than 60 minutes.</p>

        <x-docs.copyable-code
            class="mt-5"
            :code="$storageConfig"
            copy-label="Copy storage configuration"
            copy-success="Storage configuration copied"
            :multiline="true"
        />

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">Increase retention for a longer local workflow. Keep a custom path private and outside version control.</p>
    </x-docs.section>

    <x-docs.section id="collection" title="Bound large profiles">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Collection limits keep unusual requests quick to encode, store, render, and return through MCP. The defaults retain up to 500 top-level records per collector, 100 nested values per array, five nested levels, and 2,000 characters per ordinary string.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">Application call sites are on by default. The package keeps five useful application frames while scanning up to 40 raw frames to find them below framework internals. Turn call sites off only when you are isolating their cost in an unusual local workload.</p>
    </x-docs.section>

    <x-docs.section id="sensitive-values" title="Choose how local values are retained">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Exact local values make a debugger useful. Query bindings and cache or Redis keys are therefore retained by default within the collection limits.</p>

        <ul class="mt-5 space-y-3" role="list">
            <x-docs.check-item>Set <code class="break-all font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">NEWDEBUGBAR_QUERY_BINDINGS=safe</code> to mask string bindings, or <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">none</code> to omit all bindings.</x-docs.check-item>
            <x-docs.check-item>Set <code class="break-all font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">NEWDEBUGBAR_KEY_POLICY=hash</code> when stable matching is enough and exact cache or Redis keys should not be stored.</x-docs.check-item>
        </ul>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">These choices apply when the profile is captured. Changing them later does not rewrite profiles already on disk.</p>
    </x-docs.section>

    <x-docs.next-step
        :href="route('docs.data-and-privacy')"
        title="Review what is stored"
        description="See where profiles live, when they are removed, which limits apply, and how value policies affect browser and MCP output."
        link-label="Open data and privacy"
    />
</x-layouts.docs>
