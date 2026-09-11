@php
    $diagram1 = [['title' => 'Run the command', 'description' => 'Laravel records the command lifecycle and supported activity.'], ['title' => 'Find its profile', 'description' => 'Match the runtime name, recorded time, and exit code through MCP.'], ['title' => 'Inspect the cause', 'description' => 'Follow findings, queries, logs, and retained source evidence.']];

    $example2 = <<<'EXAMPLE2'
php artisan morrow:refresh kyoto-autumn
EXAMPLE2;

    $example3 = '<'.'?php'."\n\n".<<<'EXAMPLE3'
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/** Produces a small command profile with a controlled exit status. */
class InspectWorkspaceCommand extends Command
{
    protected $signature = 'app:inspect-workspace {--fail}';

    protected $description = 'Inspect the local workspace connection';

    public function handle(): int
    {
        DB::select('select 1');
        Log::info('Workspace connection checked.');

        return $this->option('fail') ? self::FAILURE : self::SUCCESS;
    }
}
EXAMPLE3;

    $example4 = <<<'EXAMPLE4'
php artisan app:inspect-workspace
php artisan app:inspect-workspace --fail
EXAMPLE4;

    $example5 = <<<'EXAMPLE5'
{
  "path": "artisan:app:inspect-workspace",
  "limit": 5
}
EXAMPLE5;

@endphp

<x-layouts.docs
    meta-title="Profile an Artisan command | The New Debug Bar"
    description="Inspect Laravel Artisan command profiles, exit codes, queries, logs, and failures through The New Debug Bar local MCP server."
    :canonical="url('/docs/artisan')"
    og-title="Profile an Artisan command"
    og-description="Inspect Laravel Artisan command profiles, exit codes, queries, logs, and failures through The New Debug Bar local MCP server."
    page-title="Artisan commands"
    :sections="[
        ['id' => 'start', 'label' => 'Start with an installed local app'],
        ['id' => 'example', 'label' => 'Try a small command with a clear result'],
        ['id' => 'find', 'label' => 'Find the exact runtime profile'],
        ['id' => 'workers', 'label' => 'Workers and long-running commands'],
        ['id' => 'tests', 'label' => 'What a test-command profile means'],
        ['id' => 'verify', 'label' => 'Verify the command result'],
    ]"
>
    <x-docs.page-header category="Debugging workflows" title="Profile an Artisan command">
        Supported Artisan commands get their own profiles. Use the local MCP server to inspect what happened after the command exits.
    </x-docs.page-header>

    <x-docs.flow :steps="$diagram1" caption="A command profile describes work in that process. Queue workers create individual job profiles." />

    <x-docs.section id="start" title="Start with an installed local app">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Install the package and connect <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.mcp') }}">MCP</a> to the same Laravel app. Its command process must use an allowed environment and the same accessible profile storage.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">In the <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="https://github.com/newdebugbar/benchmark">public benchmark</a>, this command refreshes a journey and creates query, cache, Redis, and log activity:</p>

        <x-docs.copyable-code class="mt-5" :code="$example2" copy-label="Copy benchmark command" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">That command belongs to the benchmark, not The New Debug Bar package. For your own app, run an existing finite Artisan command.</p>
    </x-docs.section>

    <x-docs.section id="example" title="Try a small command with a clear result">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Create <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">app/Console/Commands/InspectWorkspaceCommand.php</code> in a local example app. Register it through your Laravel version’s normal command registration if the app does not discover that directory.</p>

        <x-docs.copyable-code class="mt-5" :code="$example3" copy-label="Copy example command" copy-success="Example copied" :multiline="true" />

        <x-docs.copyable-code class="mt-5" :code="$example4" copy-label="Copy command checks" copy-success="Example copied" :multiline="true" />
    </x-docs.section>

    <x-docs.section id="find" title="Find the exact runtime profile">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Ask your agent to call <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">list-debug-profiles</code> with a path fragment matching the command:</p>

        <x-docs.copyable-code class="mt-5" :code="$example5" copy-label="Copy command-profile lookup" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Choose by runtime name, recorded time, and exit code. Read the Request inspector, which is labeled Runtime for non-HTTP work, then Queries and Logs. The failure case should have exit code 1; the successful case should have exit code 0.</p>

        <x-docs.callout class="mt-6" title="Names, not command values">Argument and option names can be retained. Do not expect command argument values or a full copy of terminal output in the profile.</x-docs.callout>
    </x-docs.section>

    <x-docs.section id="workers" title="Workers and long-running commands">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The package does not wrap <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">queue:work</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">queue:listen</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">horizon</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">mcp:start</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">mcp:inspector</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">octane:start</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">reverb:start</code>, <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">schedule:work</code>, or <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">serve</code> in one unbounded command profile. Queue jobs can create separate profiles when they execute.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Use <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.queues') }}">Queues</a> to move from an originating request to worker attempts. Restart a worker after a change that requires it to reload application code or configuration.</p>
    </x-docs.section>

    <x-docs.section id="tests" title="What a test-command profile means">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">An Artisan <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">test</code> lifecycle can be labeled as test-command context. That is not per-test-case tracing and does not guarantee that child-process activity is captured. To protect a particular HTTP route, use the exact response ID and <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.testing') }}">profile assertions</a>.</p>
    </x-docs.section>

    <x-docs.section id="verify" title="Verify the command result">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Check the command’s real exit code or output separately, then compare it with the profile. A healthy profile does not prove every side effect completed; a nonzero exit code does not automatically contain an exception. Follow the evidence that the command actually retained.</p>
    </x-docs.section>

    <x-docs.next-step
        :href="route('docs.queues')"
        title="Follow background jobs"
        description="Inspect each job attempt separately from the command that keeps the worker running."
        link-label="Read the guide"
    />
</x-layouts.docs>
