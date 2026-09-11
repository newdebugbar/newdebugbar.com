@php
    $diagram1 = [['title' => 'Web runtime', 'description' => 'PHP captures the request in the Laravel app.'], ['title' => 'Profile directory', 'description' => 'The app stores the retained profile and background correlation data.'], ['title' => 'MCP and workers', 'description' => 'The other local processes need the intended app environment and access to that evidence.']];

    $example2 = <<<'EXAMPLE2'
php -v
php /absolute/path/to/your-app/artisan env
EXAMPLE2;

    $example3 = <<<'EXAMPLE3'
{
  "command": "docker",
  "args": [
    "compose",
    "--file", "/absolute/path/to/your-app/compose.yaml",
    "exec", "-T",
    "laravel.test",
    "php", "artisan", "mcp:start", "newdebugbar"
  ]
}
EXAMPLE3;

    $example4 = <<<'EXAMPLE4'
docker compose --file /absolute/path/to/your-app/compose.yaml exec -T laravel.test php -v
docker compose --file /absolute/path/to/your-app/compose.yaml exec -T laravel.test php artisan env
EXAMPLE4;

@endphp

<x-layouts.docs
    meta-title="Connect the same app across local runtimes | The New Debug Bar"
    description="Keep Laravel web requests, MCP commands, containers, and queue workers aligned on the correct PHP runtime, environment, and profile storage."
    :canonical="url('/docs/local-environments')"
    og-title="Connect the same app across local runtimes"
    og-description="Keep Laravel web requests, MCP commands, containers, and queue workers aligned on the correct PHP runtime, environment, and profile storage."
    page-title="Local environments"
    :sections="[
        ['id' => 'host', 'label' => 'Host PHP, Herd, and Valet'],
        ['id' => 'containers', 'label' => 'Docker and Sail'],
        ['id' => 'storage', 'label' => 'Check the profile directory'],
        ['id' => 'workers', 'label' => 'Keep workers on the same setup'],
        ['id' => 'long-lived', 'label' => 'Verify long-lived runtime boundaries'],
        ['id' => 'check', 'label' => 'Use one end-to-end check'],
    ]"
>
    <x-docs.page-header category="Getting started" title="Connect the same app across local runtimes">
        The browser, coding client, and worker must point to the same application evidence. Similar paths on different machines are not the same files.
    </x-docs.page-header>

    <x-docs.flow :steps="$diagram1" caption="The important link is shared application context and storage, not a matching browser URL alone." />

    <x-docs.section id="host" title="Host PHP, Herd, and Valet">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Use the PHP executable that is compatible with the app’s web runtime. Check the PHP and Laravel environment used by your terminal or client:</p>

        <x-docs.copyable-code class="mt-5" :code="$example2" copy-label="Copy host-runtime checks" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Compare those facts with the runtime context captured by the web request. A per-site PHP selection in Herd or Valet can differ from the <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">php</code> found by a desktop application. Use an absolute executable path in the MCP configuration when needed.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Keep the Artisan path specific to the app. Two worktrees or two Laravel projects should not accidentally share the same manually configured MCP server command.</p>
    </x-docs.section>

    <x-docs.section id="containers" title="Docker and Sail">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Start the MCP process inside the application container when that is where Laravel and its dependencies run. The following Docker Compose example is a configuration pattern: replace the Compose file and service name with your project’s values, then verify them before connecting.</p>

        <x-docs.copyable-code class="mt-5" :code="$example3" copy-label="Copy container server pattern" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">This assumes the service’s working directory contains <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">artisan</code>, as in a standard Sail application service. <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">-T</code> disables a pseudo-terminal so the MCP protocol can use standard input and output. The Docker executable must be available to the coding client.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Check the container itself before troubleshooting the client:</p>

        <x-docs.copyable-code class="mt-5" :code="$example4" copy-label="Copy container checks" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">These commands are based on <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="https://laravel.com/framework/docs/13.x/sail">Laravel Sail</a> and <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="https://docs.docker.com/reference/cli/docker/compose/exec/">Docker Compose exec</a>. A custom service, working directory, or filesystem mount needs the corresponding change.</p>
    </x-docs.section>

    <x-docs.section id="storage" title="Check the profile directory">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">By default, profiles live in <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">storage/framework/newdebugbar</code> inside the Laravel app. A browser process in a container and host-side PHP may use different storage, database addresses, and environment values even when both can read the same source tree.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Prefer running MCP in the intended application runtime. If you use a custom storage path, make it readable by the relevant processes and keep the profile and correlation data together. Confirm one fresh response ID can be read by the client.</p>
    </x-docs.section>

    <x-docs.section id="workers" title="Keep workers on the same setup">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">A queue worker needs the package enabled in an allowed environment, the intended queue connection, and access to the retained profiles. Restart long-lived workers after relevant code or configuration changes.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Compare the job’s connection, queue, and attempt facts with the origin profile. Use <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.queues') }}">Queues</a> when a dispatch remains pending or a retry creates several worker profiles.</p>
    </x-docs.section>

    <x-docs.section id="long-lived" title="Verify long-lived runtime boundaries">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">A recorded Octane, FrankenPHP, or RoadRunner runtime label identifies the process. It is not a promise of dedicated integration with every server option or child process.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Check at least two different requests and a failed request in your runtime. The selected profile must contain that request’s work rather than activity carried over from another request. Follow the runtime’s normal reload procedure after changing the package.</p>
    </x-docs.section>

    <x-docs.section id="check" title="Use one end-to-end check">
        <ul class="mt-5 space-y-3" role="list">
            <x-docs.check-item>Visit one known HTML or API route and copy its response profile ID.</x-docs.check-item>
            <x-docs.check-item>Read that exact ID through MCP and compare method, path, and a visible metric.</x-docs.check-item>
            <x-docs.check-item>If the flow dispatches a job, run the intended worker and open its correlated result.</x-docs.check-item>
            <x-docs.check-item>If any step fails, keep the exact command, runtime facts, and error for the relevant <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.troubleshooting') }}">troubleshooting guide</a>.</x-docs.check-item>
        </ul>
    </x-docs.section>
</x-layouts.docs>
