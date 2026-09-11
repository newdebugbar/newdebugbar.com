@php
    $diagram1 = [['title' => 'No working bar', 'description' => 'Check whether Laravel captured the response and whether the browser loaded the interface.'], ['title' => 'No agent connection', 'description' => 'Check the local command, PHP runtime, and the five advertised tools.'], ['title' => 'Missing evidence', 'description' => 'Check the selected profile, retained data, and response limits.']];

    $example2 = <<<'EXAMPLE2'
php -v
composer show newdebugbar/newdebugbar
composer show livewire/livewire
php artisan env
EXAMPLE2;

@endphp

<x-layouts.docs
    meta-title="Find the right troubleshooting guide | The New Debug Bar"
    description="Fix a missing Laravel debug bar, an MCP connection problem, or missing request profiles with focused checks and a visible result."
    :canonical="url('/docs/troubleshooting')"
    og-title="Find the right troubleshooting guide"
    og-description="Fix a missing Laravel debug bar, an MCP connection problem, or missing request profiles with focused checks and a visible result."
    page-title="Troubleshooting"
    :sections="[
        ['id' => 'choose', 'label' => 'What stopped working?'],
        ['id' => 'evidence', 'label' => 'Keep one useful piece of evidence'],
        ['id' => 'report', 'label' => 'If the focused checks do not resolve it'],
    ]"
>
    <x-docs.page-header category="Troubleshooting" title="Find the right troubleshooting guide">
        Start with what failed. A missing toolbar, a disconnected agent, and an empty inspector need different checks.
    </x-docs.page-header>

    <x-docs.flow :steps="$diagram1" caption="Choose the failing part of the workflow before changing configuration." />

    <x-docs.section id="choose" title="What stopped working?">
        <div class="mt-6 overflow-x-auto rounded-xl border border-zinc-200 dark:border-white/10">
            <table class="w-full min-w-[34rem] text-left text-sm">
                <thead class="bg-zinc-50 text-zinc-950 dark:bg-white/[0.035]">
                    <tr>
                        <th class="px-4 py-3 font-semibold" scope="col">Symptom</th>
                        <th class="px-4 py-3 font-semibold" scope="col">Start here</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 text-zinc-600 dark:divide-white/10 dark:text-zinc-400">
                    <tr>
                        <td class="px-4 py-3 align-top">The bar is missing, blank, or will not open</td>
                        <td class="px-4 py-3 align-top"><a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.troubleshooting.bar-not-showing') }}">The bar is missing or will not open</a></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">The agent cannot start the server or find its tools</td>
                        <td class="px-4 py-3 align-top"><a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.troubleshooting.mcp') }}">Fix an MCP connection</a></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">The right request, inspector, or value is missing</td>
                        <td class="px-4 py-3 align-top"><a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.troubleshooting.missing-profiles') }}">Find missing profiles and data</a></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">A queued job still looks pending</td>
                        <td class="px-4 py-3 align-top"><a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.queues') }}">Follow the job into its worker profile</a></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">An EXPLAIN plan is unavailable</td>
                        <td class="px-4 py-3 align-top"><a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.queries') }}">Check the query and its retained bindings</a></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">A form stays on the same screen</td>
                        <td class="px-4 py-3 align-top"><a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.validation') }}">Inspect the validation attempt</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </x-docs.section>

    <x-docs.section id="evidence" title="Keep one useful piece of evidence">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Repeat one action and note its method, path, time, and the <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">X-NewDebugBar-Profile</code> response header when present. Keep the exact browser or MCP error. That separates a new failure from an old profile or a background request.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">For installation problems, record the package versions and the PHP version used by the command that failed:</p>

        <x-docs.copyable-code class="mt-5" :code="$example2" copy-label="Copy environment checks" copy-success="Example copied" :multiline="true" />
    </x-docs.section>

    <x-docs.section id="report" title="If the focused checks do not resolve it">
        <ul class="mt-5 space-y-3" role="list">
            <x-docs.check-item>Describe the smallest action that reproduces the problem and what you expected to happen.</x-docs.check-item>
            <x-docs.check-item>Include PHP, Laravel, Livewire, and The New Debug Bar versions, plus the relevant local runtime: host PHP, container, or worker.</x-docs.check-item>
            <x-docs.check-item>Include the exact error and a small relevant excerpt. An expired profile ID by itself is not a portable bug report.</x-docs.check-item>
            <x-docs.check-item>Say which guide checks you tried and what each returned.</x-docs.check-item>
        </ul>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Open an issue in the <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="https://github.com/newdebugbar/newdebugbar/issues">package issue tracker</a>.</p>
    </x-docs.section>
</x-layouts.docs>
