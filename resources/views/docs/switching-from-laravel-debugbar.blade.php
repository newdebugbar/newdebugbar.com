@php
    $example1 = <<<'EXAMPLE1'
composer remove --dev fruitcake/laravel-debugbar
EXAMPLE1;

@endphp

<x-layouts.docs
    meta-title="Switch from Laravel Debugbar | The New Debug Bar"
    description="Plan a practical switch from Laravel Debugbar to The New Debug Bar by checking requirements, existing helper calls, storage, source actions, and agent workflows."
    :canonical="url('/docs/switching-from-laravel-debugbar')"
    og-title="Switch from Laravel Debugbar"
    og-description="Plan a practical switch from Laravel Debugbar to The New Debug Bar by checking requirements, existing helper calls, storage, source actions, and agent workflows."
    page-title="Switch from Laravel Debugbar"
    :sections="[
        ['id' => 'requirements', 'label' => 'Check the application requirements'],
        ['id' => 'inventory', 'label' => 'Find application calls before removing anything'],
        ['id' => 'differences', 'label' => 'Understand the current workflow differences'],
        ['id' => 'install', 'label' => 'Install and verify one local workflow'],
        ['id' => 'remove', 'label' => 'Remove the old package when its consumers are handled'],
        ['id' => 'verify', 'label' => 'Check behavior after the switch'],
    ]"
>
    <x-docs.page-header category="Getting started" title="Switch from Laravel Debugbar">
        Check which parts of Laravel Debugbar your app actually uses, then move one local debugging workflow at a time.
    </x-docs.page-header>

    <x-docs.screenshot name="requests" alt="The New Debug Bar request inspector with route, authentication, and response context" caption="Start by confirming the same application request in the new inspector before removing the old package." />

    <x-docs.section id="requirements" title="Check the application requirements">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Read <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.installation') }}">Installation</a> first. The New Debug Bar uses Livewire 4 for its interface. An app does not need to use Livewire itself, but an app constrained to Livewire 3 cannot install it alongside that dependency.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Identify the Laravel Debugbar package actually installed in Composer. Recent versions use <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">fruitcake/laravel-debugbar</code>; older applications may use <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">barryvdh/laravel-debugbar</code>.</p>
    </x-docs.section>

    <x-docs.section id="inventory" title="Find application calls before removing anything">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Search application code, Blade templates, tests, and service providers for these integration points:</p>

        <ul class="mt-5 space-y-3" role="list">
            <x-docs.check-item>The <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">Debugbar</code> facade and calls such as <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">Debugbar::info()</code> or <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">Debugbar::startMeasure()</code>.</x-docs.check-item>
            <x-docs.check-item>The <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">debugbar()</code> and <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">debug()</code> helpers, collection debug calls, and custom collectors.</x-docs.check-item>
            <x-docs.check-item>Explicit service-provider registration, aliases, and published <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">config/debugbar.php</code> settings.</x-docs.check-item>
            <x-docs.check-item>Agent commands, skills, or scripts that call Laravel Debugbar’s Artisan commands.</x-docs.check-item>
        </ul>

        <x-docs.callout class="mt-6" title="Existing helpers are not interchangeable">The New Debug Bar does not provide a drop-in replacement for Laravel Debugbar’s custom message, measurement, collector, or helper APIs. Inventory and adapt those consumers first.</x-docs.callout>
    </x-docs.section>

    <x-docs.section id="differences" title="Understand the current workflow differences">
        <div class="mt-6 overflow-x-auto rounded-xl border border-zinc-200 dark:border-white/10">
            <table class="w-full min-w-[34rem] text-left text-sm">
                <thead class="bg-zinc-50 text-zinc-950 dark:bg-white/[0.035] dark:text-white">
                    <tr>
                        <th class="px-4 py-3 font-semibold" scope="col">Workflow</th>
                        <th class="px-4 py-3 font-semibold" scope="col">The New Debug Bar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 text-zinc-600 dark:divide-white/10 dark:text-zinc-400">
                    <tr>
                        <td class="px-4 py-3 align-top">Recent requests</td>
                        <td class="px-4 py-3 align-top">The browser picker discovers requests on the current page. MCP can list retained profiles outside that list.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Storage</td>
                        <td class="px-4 py-3 align-top">Local profile files with count and age limits; no package database migration.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Application source</td>
                        <td class="px-4 py-3 align-top">Source controls copy a location. Do not assume editor navigation or container path mapping.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Coding agents</td>
                        <td class="px-4 py-3 align-top">Five focused, read-only MCP tools with bounded access to retained profile evidence.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Manual messages</td>
                        <td class="px-4 py-3 align-top">Use Laravel logging for ordinary request context; there is no equivalent custom diagnostics API yet.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Custom timers or collectors</td>
                        <td class="px-4 py-3 align-top">Do not remove their current implementation expecting The New Debug Bar to replace them.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Laravel Debugbar also documents agent commands and an agent skill. Compare the actual workflows you need rather than treating agent support as unique. See its <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="https://laraveldebugbar.com/usage/">current usage guide</a>.</p>
    </x-docs.section>

    <x-docs.section id="install" title="Install and verify one local workflow">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Use the current <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.installation') }}">installation command</a>. Load a known page, select the exact request, and inspect Queries plus the inspector you use most. If you use an agent, connect MCP and read the same response ID.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Temporarily running two debuggers adds collection overhead. Their diagnostic totals and interfaces are separate. Use that overlap to compare a specific workflow, then choose the intended setup.</p>
    </x-docs.section>

    <x-docs.section id="remove" title="Remove the old package when its consumers are handled">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">When Composer lists <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">fruitcake/laravel-debugbar</code> and you have replaced or removed the app’s uses of it, remove that development dependency:</p>

        <x-docs.copyable-code class="mt-5" :code="$example1" copy-label="Copy removal command" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Use <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">barryvdh/laravel-debugbar</code> instead only if that is the package your application actually has installed. Review its now-unused config, aliases, and explicit provider registration rather than deleting unrelated files.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Adapt agent instructions to the <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.mcp') }}">The New Debug Bar setup</a> and <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.mcp-tools') }}">tool names</a>.</p>
    </x-docs.section>

    <x-docs.section id="verify" title="Check behavior after the switch">
        <ul class="mt-5 space-y-3" role="list">
            <x-docs.check-item>Load the important page and exercise a later fetch or Livewire update.</x-docs.check-item>
            <x-docs.check-item>Check the captured SQL, application source, exceptions, and your most-used inspector.</x-docs.check-item>
            <x-docs.check-item>Run application tests that cover any changed helper or logging code.</x-docs.check-item>
            <x-docs.check-item>Confirm the agent reads the correct app and profile.</x-docs.check-item>
            <x-docs.check-item>Keep unresolved needs explicit; do not substitute a roadmap feature for a current capability.</x-docs.check-item>
        </ul>
    </x-docs.section>
</x-layouts.docs>
