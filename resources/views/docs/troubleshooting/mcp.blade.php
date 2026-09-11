@php
    $diagram1 = [['title' => 'Client', 'description' => 'Starts the configured executable with the Artisan path and arguments.'], ['title' => 'Laravel process', 'description' => 'Boots the intended app and registers The New Debug Bar server.'], ['title' => 'Saved profiles', 'description' => 'The five tools read profiles from that app’s configured storage.']];

    $example2 = <<<'EXAMPLE2'
/absolute/path/to/php -v
/absolute/path/to/php /absolute/path/to/your-app/artisan env
EXAMPLE2;

@endphp

<x-layouts.docs
    meta-title="Fix an MCP connection | The New Debug Bar"
    description="Diagnose PHP paths, wrong Laravel applications, startup errors, missing MCP tools, and an empty profile list."
    :canonical="url('/docs/troubleshooting/mcp')"
    og-title="Fix an MCP connection"
    og-description="Diagnose PHP paths, wrong Laravel applications, startup errors, missing MCP tools, and an empty profile list."
    page-title="MCP connection problems"
    :sections="[
        ['id' => 'command', 'label' => 'Check the executable and the application'],
        ['id' => 'startup', 'label' => 'Read a startup failure before retrying'],
        ['id' => 'tools', 'label' => 'Confirm the five tools are available'],
        ['id' => 'profiles', 'label' => 'Connected, but no profiles appear?'],
        ['id' => 'errors', 'label' => 'Distinguish missing data from a tool error'],
        ['id' => 'verify', 'label' => 'Prove the connection works'],
    ]"
>
    <x-docs.page-header category="Troubleshooting" title="Fix an MCP connection">
        The coding client starts a local Artisan process. Test that command and its environment before changing your debugging prompt.
    </x-docs.page-header>

    <x-docs.flow :steps="$diagram1" caption="A client can connect successfully and still read the wrong app or an empty profile directory." />

    <x-docs.section id="command" title="Check the executable and the application">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Start with the command recorded in your <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.mcp') }}">client setup</a>. The executable must exist, and the Artisan path must belong to the app you are debugging. Check the same PHP runtime:</p>

        <x-docs.copyable-code class="mt-5" :code="$example2" copy-label="Copy runtime checks" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Replace both paths. A desktop client may not inherit your shell’s PHP path, aliases, or environment. For Docker or Sail, use a command that starts PHP inside the application container; see <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.local-environments') }}">Local environments</a>.</p>
    </x-docs.section>

    <x-docs.section id="startup" title="Read a startup failure before retrying">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Check the client’s MCP log for the first startup error. Missing PHP, a missing Artisan file, a Composer/autoload failure, or a Laravel bootstrap exception must be resolved before tool discovery can work.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Confirm that the process uses an allowed environment and that <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">NEWDEBUGBAR_ENABLED</code> is not false. If configuration changed, clear the app’s configuration cache and restart this MCP connection.</p>

        <x-docs.callout class="mt-6" title="A quiet terminal is normal"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">php artisan mcp:start newdebugbar</code> is a stdio server: it waits for protocol messages. Your client normally owns this process. A waiting terminal by itself is not a successful connection test.</x-docs.callout>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">If the client reports malformed JSON or invalid protocol output, check for application startup code writing banners, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">echo</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">dump()</code>, or <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">dd()</code> to standard output. Keep protocol output separate from application logs.</p>
    </x-docs.section>

    <x-docs.section id="tools" title="Confirm the five tools are available">
        <ul class="mt-5 space-y-3" role="list">
            <x-docs.check-item><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">list-debug-profiles</code></x-docs.check-item>
            <x-docs.check-item><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">get-debug-profile-inspector</code></x-docs.check-item>
            <x-docs.check-item><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">get-debug-profile-data</code></x-docs.check-item>
            <x-docs.check-item><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">inspect-debug-queries</code></x-docs.check-item>
            <x-docs.check-item><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">get-debug-findings</code></x-docs.check-item>
        </ul>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Restart the connection after fixing startup. If the server is listed but these tools are absent, inspect the initialization error and confirm the client started this app’s <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">newdebugbar</code> server.</p>
    </x-docs.section>

    <x-docs.section id="profiles" title="Connected, but no profiles appear?">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Visit one page in the Laravel app and read its <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">X-NewDebugBar-Profile</code> header. Ask the agent to open that exact ID. An empty list is a data or environment check, not proof of a connection failure.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Check that the browser PHP process and MCP process use the same profile directory and can read its files. Host PHP, containers, worktrees, and remote machines can have different directories with similar-looking paths.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Use <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.troubleshooting.missing-profiles') }}">missing-profile checks</a> for retention, omitted data, and a profile that has expired.</p>
    </x-docs.section>

    <x-docs.section id="errors" title="Distinguish missing data from a tool error">
        <div class="mt-6 overflow-x-auto rounded-xl border border-zinc-200 dark:border-white/10">
            <table class="w-full min-w-[34rem] text-left text-sm">
                <thead class="bg-zinc-50 text-zinc-950 dark:bg-white/[0.035]">
                    <tr>
                        <th class="px-4 py-3 font-semibold" scope="col">Result</th>
                        <th class="px-4 py-3 font-semibold" scope="col">Next step</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 text-zinc-600 dark:divide-white/10 dark:text-zinc-400">
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">status: ok</code></td>
                        <td class="px-4 py-3 align-top">Read the response and continue with its returned paths or cursor.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top"><code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">status: not_found</code></td>
                        <td class="px-4 py-3 align-top">Check the exact ID, requested inspector or path, and retention. The missing object may be a path rather than the whole profile.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Tool error with <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">status: partial</code></td>
                        <td class="px-4 py-3 align-top">Use the retained data, inspect <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">background_error</code>, and retry background refresh. Treat <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">background_pending: null</code> as unknown.</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 align-top">Other processing or storage error</td>
                        <td class="px-4 py-3 align-top">Read the reported error. Do not relabel it as an expired profile.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </x-docs.section>

    <x-docs.section id="verify" title="Prove the connection works">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Capture one fresh request, list it, and read its Request or Queries inspector. Compare method, path, and a visible metric with the browser. You now have proof that the client can read the intended app’s actual saved data.</p>
    </x-docs.section>

    <x-docs.next-step
        :href="route('docs.debugging-with-agents')"
        title="Debug one problem from start to finish"
        description="Use the working connection to trace a repeated query and verify a focused change."
        link-label="Read the guide"
    />
</x-layouts.docs>
