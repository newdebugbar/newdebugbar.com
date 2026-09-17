@php
    $diagram1 = [['title' => 'Laravel app', 'description' => 'Capture the local request you want the agent to investigate.'], ['title' => 'Local MCP server', 'description' => 'The coding client starts this app’s Artisan command and reads its saved profiles.'], ['title' => 'Agent workflow', 'description' => 'Use exact evidence to make a focused change and verify the same behavior.']];

@endphp

@php
    $codexPluginCommands = implode("\n", [
        'codex plugin marketplace add newdebugbar/newdebugbar',
        'codex plugin add newdebugbar@newdebugbar',
    ]);

    $cursorConfig = <<<'JSON'
{
  "mcpServers": {
    "newdebugbar": {
      "command": "php",
      "args": [
        "/absolute/path/to/your-app/artisan",
        "mcp:start",
        "newdebugbar"
      ]
    }
  }
}
JSON;

    $vscodeConfig = <<<'JSON'
{
  "servers": {
    "newdebugbar": {
      "type": "stdio",
      "command": "php",
      "args": [
        "/absolute/path/to/your-app/artisan",
        "mcp:start",
        "newdebugbar"
      ]
    }
  }
}
JSON;

    $genericConfig = <<<'JSON'
{
  "command": "php",
  "args": [
    "/absolute/path/to/your-app/artisan",
    "mcp:start",
    "newdebugbar"
  ]
}
JSON;

    $tools = [
        'list-debug-profiles',
        'get-debug-profile-inspector',
        'get-debug-profile-data',
        'inspect-debug-queries',
        'get-debug-findings',
    ];
@endphp

<x-layouts.docs
    meta-title="Connect The New Debug Bar to Codex, Claude, Cursor, or VS Code"
    description="Connect The New Debug Bar's local MCP server to Codex, Claude Code, Cursor, VS Code, or another coding agent so it can inspect exact Laravel request profiles."
    :canonical="url('/docs/mcp')"
    og-title="Connect The New Debug Bar to your coding agent"
    og-description="Give Codex, Claude Code, Cursor, VS Code, and other local MCP clients exact Laravel request profiles instead of logs and guesses."
    page-title="MCP setup"
    :sections="[
        ['id' => 'before-you-start', 'label' => 'Before you start'],
        ['id' => 'codex', 'label' => 'Codex'],
        ['id' => 'claude-code', 'label' => 'Claude Code'],
        ['id' => 'cursor', 'label' => 'Cursor'],
        ['id' => 'vscode', 'label' => 'VS Code'],
        ['id' => 'other-clients', 'label' => 'Other clients'],
        ['id' => 'check-connection', 'label' => 'Check the connection'],
        ['id' => 'debug-workflow', 'label' => 'Debug with an agent'],
        ['id' => 'troubleshooting', 'label' => 'Troubleshooting'],
        ['id' => 'next-workflow', 'label' => 'Continue from connection to a verified fix'],
        ['id' => 'client-references', 'label' => 'Client documentation'],
    ]"
>
    <x-docs.page-header category="Use with agents" title="Connect The New Debug Bar to your coding agent">
        Let Codex, Claude Code, Cursor, VS Code, or another local MCP client read the exact profile saved for each Laravel request.
    </x-docs.page-header>

    <x-docs.flow :steps="$diagram1" caption="Client setup connects the data. The debugging walkthrough shows how to use it." />

    <x-docs.callout class="mt-10" title="Your coding tool starts the server:">
        do not run <code class="font-mono text-[0.9em] text-zinc-900 dark:text-zinc-200">mcp:start</code> in a separate terminal.
    </x-docs.callout>

    <x-docs.section id="before-you-start" title="Before you start">
        <ul class="mt-5 space-y-3" role="list">
            <x-docs.check-item>
                <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60 dark:hover:decoration-violet-300" href="{{ route('docs.installation') }}">Install The New Debug Bar</a> in your Laravel app.
            </x-docs.check-item>
            <x-docs.check-item>
                Make sure the app uses its <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">local</code> environment.
            </x-docs.check-item>
            <x-docs.check-item>
                For manual setup, find the full path to the app's <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">artisan</code> file.
            </x-docs.check-item>
        </ul>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">The examples use <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">/absolute/path/to/your-app/artisan</code>. Replace it with your real path.</p>
    </x-docs.section>

    <x-docs.section id="codex" title="Codex">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The optional plugin for The New Debug Bar is the simplest setup. It adds product guidance and starts the MCP server from the Laravel app you have open.</p>

        <x-docs.copyable-code
            class="mt-5"
            :code="$codexPluginCommands"
            copy-label="Copy Codex plugin commands"
            copy-success="Codex plugin commands copied"
            :multiline="true"
            :prominent="true"
        />

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">Open the Laravel app's root folder in Codex and start a new task. You do not need to publish The New Debug Bar config file.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">For manual setup, add a server that points to this app and then check it:</p>

        <x-docs.copyable-code
            class="mt-5"
            code="codex mcp add my-app-debug-bar -- php /absolute/path/to/your-app/artisan mcp:start newdebugbar"
            copy-label="Copy manual Codex setup"
            copy-success="Manual Codex setup copied"
            :prompt="true"
        />

        <x-docs.copyable-code
            class="mt-4"
            code="codex mcp list"
            copy-label="Copy Codex check"
            copy-success="Codex check copied"
            :prompt="true"
        />
    </x-docs.section>

    <x-docs.section id="claude-code" title="Claude Code">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Run this command from your project. Local scope keeps the server private to you and this app.</p>

        <x-docs.copyable-code
            class="mt-5"
            code="claude mcp add --scope local --transport stdio newdebugbar -- php /absolute/path/to/your-app/artisan mcp:start newdebugbar"
            copy-label="Copy Claude Code setup"
            copy-success="Claude Code setup copied"
            :prompt="true"
        />

        <p class="mt-4 text-sm leading-6 text-zinc-500 dark:text-zinc-500">Check it with <code class="font-mono text-[0.9em] text-zinc-700 dark:text-zinc-300">claude mcp list</code>.</p>
    </x-docs.section>

    <x-docs.section id="cursor" title="Cursor">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Create <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">.cursor/mcp.json</code> in your project:</p>

        <x-docs.copyable-code
            class="mt-5"
            :code="$cursorConfig"
            copy-label="Copy Cursor configuration"
            copy-success="Cursor configuration copied"
            :multiline="true"
        />
    </x-docs.section>

    <x-docs.section id="vscode" title="VS Code">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Create <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">.vscode/mcp.json</code> in your project:</p>

        <x-docs.copyable-code
            class="mt-5"
            :code="$vscodeConfig"
            copy-label="Copy VS Code configuration"
            copy-success="VS Code configuration copied"
            :multiline="true"
        />
    </x-docs.section>

    <x-docs.section id="other-clients" title="Other MCP clients">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Add a local <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">stdio</code> server with this command and these arguments. Your client may store this setting in a different file.</p>

        <x-docs.copyable-code
            class="mt-5"
            :code="$genericConfig"
            copy-label="Copy MCP server configuration"
            copy-success="MCP server configuration copied"
            :multiline="true"
        />
    </x-docs.section>

    <x-docs.section id="check-connection" title="Check the connection">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Your coding tool should show these five read-only tools:</p>

        <ul class="mt-5 grid gap-3 sm:grid-cols-2" role="list">
            @foreach ($tools as $tool)
                <li class="rounded-lg border border-zinc-200 bg-zinc-50 px-3 py-2.5 dark:border-white/10 dark:bg-white/[0.035]">
                    <code class="font-mono text-sm text-zinc-800 dark:text-zinc-200">{{ $tool }}</code>
                </li>
            @endforeach
        </ul>

        <p class="mt-6 text-base leading-7 text-zinc-600 dark:text-zinc-400">Visit a page in your Laravel app, then ask:</p>

        <x-docs.callout class="mt-5" label="Suggested agent prompt">
            Inspect the profile from The New Debug Bar for the page I just visited. Tell me what happened, what looks wrong, and what I should inspect next.
        </x-docs.callout>

    </x-docs.section>

    <x-docs.section id="debug-workflow" title="Debug one request with an agent">
        <ol class="mt-6 space-y-6" role="list">
            <x-docs.step number="1" title="Identify the exact profile">
                Give the agent the <code class="font-mono text-[0.9em] text-zinc-900 dark:text-zinc-200">X-NewDebugBar-Profile</code> response-header value when possible. Otherwise, have it match method, path, status, request type, and recorded time from the recent list.
            </x-docs.step>
            <x-docs.step number="2" title="Read findings first">
                Ask what happened, what deserves attention, why it matters, and which retained evidence supports that lead.
            </x-docs.step>
            <x-docs.step number="3" title="Open one focused inspector">
                Use the symptom to choose Queries, Exceptions, Timeline, HTTP client, Livewire, Queue, or another small inspector instead of dumping the full profile.
            </x-docs.step>
            <x-docs.step number="4" title="Follow deeper paths only when needed">
                Use <code class="font-mono text-[0.9em] text-zinc-900 dark:text-zinc-200">get-debug-profile-data</code> with <code class="font-mono text-[0.9em] text-zinc-900 dark:text-zinc-200">/inspectors</code> and returned JSON Pointer paths to reach retained evidence omitted from a concise response.
            </x-docs.step>
        </ol>

        <div class="mt-8 grid gap-4 sm:grid-cols-2">
            <x-docs.callout label="Suggested query prompt">
                Inspect profile <code class="font-mono text-[0.9em] text-zinc-900 dark:text-zinc-200">PROFILE_ID</code>. Explain its repeated or slow queries, show the application source, and tell me what to verify before changing code.
            </x-docs.callout>
            <x-docs.callout label="Suggested failure prompt">
                Inspect profile <code class="font-mono text-[0.9em] text-zinc-900 dark:text-zinc-200">PROFILE_ID</code>. Trace the error through retained causes and application frames, then check nearby logs and timeline evidence.
            </x-docs.callout>
        </div>

        <x-docs.callout class="mt-4" tone="notice" title="Do not ask for “the latest request” when precision matters">
            A Livewire update, fetch, polling request, or local queue worker can create a newer profile after the page you meant to inspect.
        </x-docs.callout>
    </x-docs.section>

    <x-docs.section id="troubleshooting" title="Troubleshooting">
        <div class="mt-5 divide-y divide-zinc-200 border-y border-zinc-200 dark:divide-white/10 dark:border-white/10">
            <x-docs.disclosure summary="The server is missing">
                Make sure the package is installed and the app uses an allowed local environment. The package follows <code class="font-mono text-[0.9em] text-zinc-900 dark:text-zinc-200">APP_DEBUG</code> by default; an explicit <code class="font-mono text-[0.9em] text-zinc-900 dark:text-zinc-200">NEWDEBUGBAR_ENABLED=true</code> enables it even when debug mode is off, and <code class="font-mono text-[0.9em] text-zinc-900 dark:text-zinc-200">NEWDEBUGBAR_ENABLED=false</code> disables it.
            </x-docs.disclosure>
            <x-docs.disclosure summary="The command cannot find PHP">
                Replace <code class="font-mono text-[0.9em] text-zinc-900 dark:text-zinc-200">php</code> with the full path to your PHP program.
            </x-docs.disclosure>
            <x-docs.disclosure summary="The wrong Laravel app opens">
                Check that the configured path points to that app's <code class="font-mono text-[0.9em] text-zinc-900 dark:text-zinc-200">artisan</code> file.
            </x-docs.disclosure>
            <x-docs.disclosure summary="No profiles appear">
                Visit a normal page in the Laravel app first, then ask the client to list recent profiles again.
            </x-docs.disclosure>
            <x-docs.disclosure summary="The client only runs online">
                The New Debug Bar needs a local MCP client that can start a command on your computer.
            </x-docs.disclosure>
        </div>
    </x-docs.section>
    <x-docs.section id="next-workflow" title="Continue from connection to a verified fix">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Use <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.debugging-with-agents') }}">Debug with an agent</a> for a complete repeated-query investigation, including the code change and the check afterward. Use the <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.mcp-tools') }}">MCP tool reference</a> for exact inputs, paths, cursors, defaults, and errors.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">For host PHP, Sail, Docker, and worker context, use <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.local-environments') }}">Local environments</a>. For startup errors or missing tools, use <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.troubleshooting.mcp') }}">MCP troubleshooting</a>.</p>
    </x-docs.section>

    <x-docs.section id="client-references" title="Client documentation">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The commands above start the same local stdio server. Client configuration and management details are documented by <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="https://learn.chatgpt.com/docs/extend/mcp?surface=cli">OpenAI</a>, <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="https://code.claude.com/docs/en/mcp">Claude Code</a>, <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="https://prod.cursor.com/help/customization/mcp">Cursor</a>, and <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="https://code.visualstudio.com/docs/agents/reference/mcp-configuration">VS Code</a>.</p>
    </x-docs.section>

</x-layouts.docs>
