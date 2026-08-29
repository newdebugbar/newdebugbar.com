@php($installation = config('newdebugbar.installation'))

<x-layouts.docs
    meta-title="Install New Debug Bar in Laravel | New Debug Bar"
    description="Install New Debug Bar in a Laravel app, check that it is working, and learn the optional configuration steps."
    :canonical="url('/docs/installation')"
    og-title="Install New Debug Bar in Laravel"
    og-description="Add New Debug Bar to a Laravel app with one Composer command. No service provider, migrations, or asset publishing required."
    page-title="Installation"
    :sections="[
        ['id' => 'install', 'label' => 'Install'],
        ['id' => 'requirements', 'label' => 'Requirements'],
        ['id' => 'verify', 'label' => 'Check it works'],
        ['id' => 'configuration', 'label' => 'Configuration'],
        ['id' => 'troubleshooting', 'label' => 'Troubleshooting'],
    ]"
>
    <x-docs.page-header category="Getting started" title="Install New Debug Bar">
        Add it to your Laravel app with one Composer command. Laravel discovers the package and the bar appears automatically while you work locally.
    </x-docs.page-header>

    @if ($installation['prerelease'])
        <x-docs.callout
            class="mt-10"
            tone="notice"
            title="Install the development version for now"
            label="Development version note"
        >
            New Debug Bar has not tagged version 1.0 yet, so the command below installs the current <code class="font-mono text-[0.9em]">{{ $installation['constraint'] }}</code> build.
        </x-docs.callout>
    @endif

    <x-docs.section id="install" title="Install the package">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Run this command from your Laravel app:</p>

        <x-docs.copyable-code
            class="mt-5"
            :code="$installation['command']"
            copy-label="Copy Composer command"
            copy-success="Composer command copied"
            :prompt="true"
            :prominent="true"
        />

        <p class="mt-4 text-sm leading-6 text-zinc-500 dark:text-zinc-500">Keep New Debug Bar in <code class="font-mono text-[0.9em] text-zinc-700 dark:text-zinc-300">require-dev</code> so production installs skip it.</p>
    </x-docs.section>

    <x-docs.section id="requirements" title="Requirements">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Before installing, make sure the app meets these requirements:</p>

        <ul class="mt-5 space-y-3" role="list">
            <li class="flex gap-3 text-base leading-7 text-zinc-700 dark:text-zinc-300">
                <svg class="mt-1 size-5 shrink-0 text-violet-600 dark:text-violet-400" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                    <path d="m4.5 10.5 3.2 3.2 7.8-8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                PHP 8.1 or newer.
            </li>
            <li class="flex gap-3 text-base leading-7 text-zinc-700 dark:text-zinc-300">
                <svg class="mt-1 size-5 shrink-0 text-violet-600 dark:text-violet-400" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                    <path d="m4.5 10.5 3.2 3.2 7.8-8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Laravel 10 or newer.
            </li>
            <li class="flex gap-3 text-base leading-7 text-zinc-700 dark:text-zinc-300">
                <svg class="mt-1 size-5 shrink-0 text-violet-600 dark:text-violet-400" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                    <path d="m4.5 10.5 3.2 3.2 7.8-8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                A Laravel app running in its <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">local</code> environment.
            </li>
        </ul>

        <x-docs.callout class="mt-6" title="Livewire compatibility:">
            New Debug Bar uses Livewire 4 for its own interface. Your app does not need to use Livewire, but apps that already use Livewire 3 are not supported.
        </x-docs.callout>
    </x-docs.section>

    <x-docs.section id="verify" title="Check that it works">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Open any normal page in your app while Laravel is using the <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">local</code> environment. The bar should appear at the bottom of the browser.</p>

        <x-docs.callout class="mt-6" tone="success" title="No extra setup:">
            you do not need to register a service provider, run migrations, or publish frontend assets.
        </x-docs.callout>

        <x-docs.figure class="mt-7" caption="Open the compact bar to inspect the request, query count, duration, and other captured details.">
            <x-screenshots.request-inspector
                alt="New Debug Bar open over a Laravel page with request, query, and duration details"
                loading="lazy"
            />
        </x-docs.figure>
    </x-docs.section>

    <x-docs.section id="configuration" title="Optional configuration">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The defaults work without a config file. Publish one only when you need to change a setting:</p>

        <x-docs.copyable-code
            class="mt-5"
            code="php artisan vendor:publish --tag=newdebugbar-config"
            copy-label="Copy publish command"
            copy-success="Publish command copied"
            :prompt="true"
        />

        <p class="mt-6 text-base leading-7 text-zinc-600 dark:text-zinc-400">To leave the package installed but turn it off, add this to your <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">.env</code> file:</p>

        <x-docs.copyable-code
            class="mt-5"
            code="NEWDEBUGBAR_ENABLED=false"
            copy-label="Copy environment setting"
            copy-success="Environment setting copied"
        />
    </x-docs.section>

    <x-docs.section id="troubleshooting" title="Troubleshooting">
        <div class="mt-5 divide-y divide-zinc-200 border-y border-zinc-200 dark:divide-white/10 dark:border-white/10">
            <x-docs.disclosure summary="The bar does not appear">
                Confirm that Laravel reports the <code class="font-mono text-[0.9em] text-zinc-900 dark:text-zinc-200">local</code> environment and that <code class="font-mono text-[0.9em] text-zinc-900 dark:text-zinc-200">NEWDEBUGBAR_ENABLED</code> is not set to <code class="font-mono text-[0.9em] text-zinc-900 dark:text-zinc-200">false</code>. If your app uses another name for local work, publish the config and add that name to <code class="font-mono text-[0.9em] text-zinc-900 dark:text-zinc-200">newdebugbar.environments</code>. After changing config, run <code class="font-mono text-[0.9em] text-zinc-900 dark:text-zinc-200">php artisan config:clear</code> and refresh the page.
            </x-docs.disclosure>
            <x-docs.disclosure summary="Composer reports a Livewire conflict">
                <p>New Debug Bar requires Livewire 4. Apps that already depend on Livewire 3 are not supported yet, even though an app does not otherwise need to use Livewire itself. Ask Composer which dependency blocks Livewire 4:</p>

                <x-docs.copyable-code
                    class="mt-4"
                    code="composer why-not livewire/livewire ^4.1"
                    copy-label="Copy dependency check"
                    copy-success="Dependency check copied"
                    :prompt="true"
                />
            </x-docs.disclosure>
        </div>
    </x-docs.section>

    <x-docs.next-step
        href="https://github.com/newdebugbar/newdebugbar/blob/main/docs/mcp.md"
        title="Give your coding agent exact debug data"
        description="Connect the local MCP server so your agent can inspect saved request profiles instead of guessing from logs."
        link-label="Open the MCP setup guide"
    >
        <x-slot:icon>
            <svg class="size-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M8.5 7.5 4 12l4.5 4.5M15.5 7.5 20 12l-4.5 4.5M13.5 4 10.5 20" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </x-slot:icon>
    </x-docs.next-step>
</x-layouts.docs>
