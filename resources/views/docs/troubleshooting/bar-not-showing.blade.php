@php
    $example1 = <<<'EXAMPLE1'
composer show newdebugbar/newdebugbar
php artisan env
EXAMPLE1;

    $example2 = <<<'EXAMPLE2'
php artisan config:clear
EXAMPLE2;

@endphp

<x-layouts.docs
    meta-title="The bar is missing or will not open | The New Debug Bar"
    description="Diagnose missing toolbar injection, disabled profiling, JSON responses, asset failures, and Livewire startup errors in a Laravel app."
    :canonical="url('/docs/troubleshooting/bar-not-showing')"
    og-title="The bar is missing or will not open"
    og-description="Diagnose missing toolbar injection, disabled profiling, JSON responses, asset failures, and Livewire startup errors in a Laravel app."
    page-title="The bar will not open"
    :sections="[
        ['id' => 'enabled', 'label' => 'Is the package running?'],
        ['id' => 'response', 'label' => 'Was the response captured?'],
        ['id' => 'html', 'label' => 'Should this response contain a toolbar?'],
        ['id' => 'assets', 'label' => 'Is the markup present but the interface broken?'],
        ['id' => 'verify', 'label' => 'Check the result'],
    ]"
>
    <x-docs.page-header category="Troubleshooting" title="The bar is missing or will not open">
        Check capture first, then the response body, then the browser. This tells you where the toolbar stopped appearing.
    </x-docs.page-header>

    <x-docs.screenshot name="requests" alt="A populated request inspector over the Kyoto example request" caption="A successful check ends with the expected request in the inspector and useful captured evidence." />

    <x-docs.section id="enabled" title="Is the package running?">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">From the Laravel application root, check installation and the current environment:</p>

        <x-docs.copyable-code class="mt-5" :code="$example1" copy-label="Copy startup checks" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The default allowed environment is <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">local</code>. Check <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">NEWDEBUGBAR_ENABLED</code> and <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">newdebugbar.environments</code>. A value of <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">false</code>, or an environment outside that list, disables profiling, package routes, the toolbar, and MCP.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">After changing configuration, clear the configuration cache and repeat the request:</p>

        <x-docs.copyable-code class="mt-5" :code="$example2" copy-label="Copy configuration refresh" copy-success="Example copied" :multiline="true" />

        <x-docs.callout class="mt-6" title="Check debug mode and any override">By default, The New Debug Bar follows <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">APP_DEBUG</code>. Set <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">NEWDEBUGBAR_ENABLED=true</code> to keep it enabled while debug mode is off, or <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">NEWDEBUGBAR_ENABLED=false</code> to disable it. The app must still use an allowed environment. See <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.configuration') }}">Configuration</a> for the actual startup settings.</x-docs.callout>
    </x-docs.section>

    <x-docs.section id="response" title="Was the response captured?">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">In your browser’s Network panel, select the application request and look for <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">X-NewDebugBar-Profile</code>. Check the request you just made, rather than an asset or the toolbar’s own update.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">If there is no header, check the startup settings, package discovery, and whether this request is intentionally excluded. Package routes and toolbar-only Livewire updates do not create ordinary application profiles.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">If the header is present, use its ID with <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.mcp') }}">MCP</a> to check that the profile can be read. The header and successful storage are separate checks.</p>
    </x-docs.section>

    <x-docs.section id="html" title="Should this response contain a toolbar?">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The toolbar is injected into a supported HTML response with a closing <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">&lt;/body&gt;</code> tag. JSON, redirects, downloads, attachment responses, and streamed responses can be captured without receiving toolbar HTML.</p>

        <div class="mt-6 overflow-x-auto rounded-xl border border-zinc-200 dark:border-white/10">
            <table class="w-full min-w-[34rem] text-left text-sm">
                <thead class="bg-zinc-50 text-zinc-950 dark:bg-white/[0.035] dark:text-white">
                    <tr>
                        <th class="px-4 py-3 font-semibold" scope="col">Response</th>
                        <th class="px-4 py-3 font-semibold" scope="col">Expected result</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 text-zinc-600 dark:divide-white/10 dark:text-zinc-400">
                    <tr>
                        <td class="px-4 py-3 align-top">Normal HTML document</td>
                        <td class="px-4 py-3 align-top">A profile header and an injected toolbar</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">JSON or an API response</td>
                        <td class="px-4 py-3 align-top">A profile header; inspect the saved profile through MCP</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Redirect, download, or stream</td>
                        <td class="px-4 py-3 align-top">No toolbar inserted into the response body</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">HTML fragment without a closing body tag</td>
                        <td class="px-4 py-3 align-top">No automatic toolbar injection</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">If the request was captured but no toolbar was expected, continue with <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.requests') }}">Requests</a>. You do not need to add HTML to an API response.</p>
    </x-docs.section>

    <x-docs.section id="assets" title="Is the markup present but the interface broken?">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Search the response HTML for <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">id=&quot;newdebugbar&quot;</code>. When it is present, check the browser Console and Network panels for the first error, missing asset, or failed Livewire update.</p>

        <ul class="mt-5 space-y-3" role="list">
            <x-docs.check-item>A 404 points to the requested asset or update URL. Compare the URL’s host, scheme, and any application path prefix.</x-docs.check-item>
            <x-docs.check-item>A blocked-script message points to the named browser policy or Content Security Policy directive. Follow that exact message; do not disable policies broadly.</x-docs.check-item>
            <x-docs.check-item>A multiple-Alpine error means there may be two Alpine runtimes on the page. Livewire bundles Alpine; follow the matching <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="https://livewire.laravel.com/docs/4.x/troubleshooting#multiple-instances-of-alpine">Livewire troubleshooting steps</a>.</x-docs.check-item>
            <x-docs.check-item>A repeated 419 after a session change needs the failed update URL, response, and session/CSRF context. Reload once, reproduce, and inspect whether the failed request belongs to the host app or toolbar.</x-docs.check-item>
        </ul>
    </x-docs.section>

    <x-docs.section id="verify" title="Check the result">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Reload the same HTML page. Confirm its profile header, open Requests, then open Queries. Both should finish loading, and the Console should have no related startup error. If the bar still fails, attach the exact failing request and error to a <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.troubleshooting') }}">focused report</a>.</p>
    </x-docs.section>

    <x-docs.next-step
        :href="route('docs.troubleshooting.missing-profiles')"
        title="Find the exact captured request"
        description="Follow the profile ID when the bar is working but the expected evidence is missing."
        link-label="Read the guide"
    />
</x-layouts.docs>
