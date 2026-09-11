@php
    $diagram1 = [['title' => 'Capture', 'description' => 'Set which local environments run and how much evidence is retained.'], ['title' => 'Store', 'description' => 'Choose the profile directory, count limit, and age limit.'], ['title' => 'Read', 'description' => 'Return bounded inspector and MCP views of the retained data.']];

@endphp

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
    meta-title="Configure The New Debug Bar for Laravel"
    description="Configure environments, thresholds, profile storage, capture limits, query bindings, keys, and call-site evidence in The New Debug Bar."
    :canonical="url('/docs/configuration')"
    og-title="Configure The New Debug Bar"
    og-description="Use the defaults first, then tune the few settings that change profiling, retention, or captured evidence."
    page-title="Configuration"
    :sections="[
        ['id' => 'publish', 'label' => 'Publish the config'],
        ['id' => 'state', 'label' => 'State and theme'],
        ['id' => 'thresholds', 'label' => 'Thresholds'],
        ['id' => 'storage', 'label' => 'Profile storage'],
        ['id' => 'collection', 'label' => 'Collection limits'],
        ['id' => 'sensitive-values', 'label' => 'Sensitive values'],
        ['id' => 'settings-reference', 'label' => 'Complete setting reference'],
        ['id' => 'change-and-capture', 'label' => 'Verify a configuration change with a new profile'],
    ]"
>
    <x-docs.page-header category="Reference" title="Change only the defaults your app needs">
        The New Debug Bar works without a published file. Publish the configuration when your local environment, workload, or data policy needs a different runtime effect.
    </x-docs.page-header>

    <x-docs.flow :steps="$diagram1" caption="A read limit does not change what was captured. A capture policy affects only new profiles." />

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
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Thresholds decide when The New Debug Bar calls attention to captured work. They do not stop collection.</p>

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

    <x-docs.section id="settings-reference" title="Complete setting reference">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Keys below are relative to <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">newdebugbar</code> in <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">config/newdebugbar.php</code>. Defaults describe normal local use. Publish the file only when an actual workflow needs a different value.</p>

        <div class="mt-6 overflow-x-auto rounded-xl border border-zinc-200 dark:border-white/10">
            <table class="w-full min-w-[34rem] text-left text-sm">
                <thead class="bg-zinc-50 text-zinc-950 dark:bg-white/[0.035] dark:text-white">
                    <tr>
                        <th class="px-4 py-3 font-semibold" scope="col">Key</th>
                        <th class="px-4 py-3 font-semibold" scope="col">Type</th>
                        <th class="px-4 py-3 font-semibold" scope="col">Default</th>
                        <th class="px-4 py-3 font-semibold" scope="col">Runtime effect</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 text-zinc-600 dark:divide-white/10 dark:text-zinc-400">
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">enabled</code></td>
                        <td class="px-4 py-3 align-top">Boolean</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">true</code></td>
                        <td class="px-4 py-3 align-top">Starts or disables profiling, routes, the interface, and MCP. <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">NEWDEBUGBAR_ENABLED</code> controls it.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">environments</code></td>
                        <td class="px-4 py-3 align-top">List of strings</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">[&#x27;local&#x27;]</code></td>
                        <td class="px-4 py-3 align-top">Allows the package to start in the listed Laravel environments.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">theme</code></td>
                        <td class="px-4 py-3 align-top">String</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">system</code></td>
                        <td class="px-4 py-3 align-top">Starting browser theme: system, light, or dark. A saved browser choice takes precedence.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">slow_query_ms</code></td>
                        <td class="px-4 py-3 align-top">Number</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">100</code></td>
                        <td class="px-4 py-3 align-top">Marks slow database queries.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">slow_http_request_ms</code></td>
                        <td class="px-4 py-3 align-top">Number</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">250</code></td>
                        <td class="px-4 py-3 align-top">Marks slow outbound Laravel HTTP calls.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">slow_request_ms</code></td>
                        <td class="px-4 py-3 align-top">Number</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">1000</code></td>
                        <td class="px-4 py-3 align-top">Creates a finding for a slow complete request.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">findings.minimum_cache_operations</code></td>
                        <td class="px-4 py-3 align-top">Integer</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">5</code></td>
                        <td class="px-4 py-3 align-top">Minimum cache reads before a high-miss finding.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">findings.high_cache_miss_rate</code></td>
                        <td class="px-4 py-3 align-top">Number</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">0.8</code></td>
                        <td class="px-4 py-3 align-top">Miss-rate threshold, expressed as a fraction.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">findings.max_findings</code></td>
                        <td class="px-4 py-3 align-top">Integer</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">50</code></td>
                        <td class="px-4 py-3 align-top">Maximum retained findings for a profile.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">storage.path</code></td>
                        <td class="px-4 py-3 align-top">String or null</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">null</code></td>
                        <td class="px-4 py-3 align-top">Null uses storage/framework/newdebugbar in the app.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">storage.max_profiles</code></td>
                        <td class="px-4 py-3 align-top">Integer</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">20</code></td>
                        <td class="px-4 py-3 align-top">Maximum retained profile count.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">storage.max_age_minutes</code></td>
                        <td class="px-4 py-3 align-top">Integer</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">60</code></td>
                        <td class="px-4 py-3 align-top">Profile expiry age.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">mcp.max_items</code></td>
                        <td class="px-4 py-3 align-top">Integer</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">50</code></td>
                        <td class="px-4 py-3 align-top">Maximum items in one bounded MCP page.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">mcp.max_bytes</code></td>
                        <td class="px-4 py-3 align-top">Integer</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">100000</code></td>
                        <td class="px-4 py-3 align-top">Maximum bytes in one MCP response.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">mail_preview.max_body_bytes</code></td>
                        <td class="px-4 py-3 align-top">Integer</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">50000</code></td>
                        <td class="px-4 py-3 align-top">Limit for each retained HTML or text mail body.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">mail_preview.max_attachment_bytes</code></td>
                        <td class="px-4 py-3 align-top">Integer</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">2000000</code></td>
                        <td class="px-4 py-3 align-top">Retained attachment-body budget per message.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">collection.application_path</code></td>
                        <td class="px-4 py-3 align-top">String or null</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">null</code></td>
                        <td class="px-4 py-3 align-top">Null uses the Laravel base path when locating application code.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">collection.max_items_per_collector</code></td>
                        <td class="px-4 py-3 align-top">Integer</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">500</code></td>
                        <td class="px-4 py-3 align-top">Maximum top-level retained records per collector.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">collection.max_items_per_array</code></td>
                        <td class="px-4 py-3 align-top">Integer</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">100</code></td>
                        <td class="px-4 py-3 align-top">Maximum nested array values.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">collection.max_depth</code></td>
                        <td class="px-4 py-3 align-top">Integer</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">5</code></td>
                        <td class="px-4 py-3 align-top">Maximum nested capture depth.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">collection.max_string_length</code></td>
                        <td class="px-4 py-3 align-top">Integer</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">2000</code></td>
                        <td class="px-4 py-3 align-top">Limit for ordinary captured strings.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">collection.query_bindings</code></td>
                        <td class="px-4 py-3 align-top">String</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">full</code></td>
                        <td class="px-4 py-3 align-top">Full, safe, or none. <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">NEWDEBUGBAR_QUERY_BINDINGS</code> controls retained binding values.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">collection.key_policy</code></td>
                        <td class="px-4 py-3 align-top">String</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">full</code></td>
                        <td class="px-4 py-3 align-top">Full or hash. <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">NEWDEBUGBAR_KEY_POLICY</code> controls cache and Redis key evidence.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">collection.call_sites</code></td>
                        <td class="px-4 py-3 align-top">Boolean</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">true</code></td>
                        <td class="px-4 py-3 align-top">Captures supported application locations and short stacks.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">collection.call_site_frames</code></td>
                        <td class="px-4 py-3 align-top">Integer</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">5</code></td>
                        <td class="px-4 py-3 align-top">Maximum useful application frames retained for a call site.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">collection.call_site_scan_limit</code></td>
                        <td class="px-4 py-3 align-top">Integer</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">40</code></td>
                        <td class="px-4 py-3 align-top">Maximum raw frames scanned to find application frames.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">collection.exception_application_frames</code></td>
                        <td class="px-4 py-3 align-top">Integer</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">12</code></td>
                        <td class="px-4 py-3 align-top">Application frames retained for exception evidence.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">collection.exception_vendor_frames</code></td>
                        <td class="px-4 py-3 align-top">Integer</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">12</code></td>
                        <td class="px-4 py-3 align-top">Framework or package frames retained for exceptions.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">collection.exception_source_context_lines</code></td>
                        <td class="px-4 py-3 align-top">Integer</td>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">9</code></td>
                        <td class="px-4 py-3 align-top">Source-context window around the exception location.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </x-docs.section>

    <x-docs.section id="change-and-capture" title="Verify a configuration change with a new profile">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Change one relevant setting, clear cached configuration if necessary, and reproduce the same action. Existing profiles are not rewritten. A missing historical value will not reappear because you raised a limit afterward.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">If a client only needs the next part of retained data, use <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.mcp-tools') }}">MCP pagination</a> before increasing capture limits. For a missing profile or value, use the <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.troubleshooting.missing-profiles') }}">focused troubleshooting guide</a>.</p>
    </x-docs.section>

    <x-docs.next-step
        :href="route('docs.data-and-privacy')"
        title="Review what is stored"
        description="See where profiles live, when they are removed, which limits apply, and how value policies affect browser and MCP output."
        link-label="Open data and privacy"
    />
</x-layouts.docs>
