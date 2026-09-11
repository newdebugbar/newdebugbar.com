<?php

return [
    'navigation' => [
        [
            'label' => 'Getting started',
            'pages' => [
                ['route' => 'docs.installation', 'label' => 'Installation', 'description' => 'Install the package and confirm the bar appears in your Laravel app.'],
                ['route' => 'docs.requests', 'label' => 'Requests', 'description' => 'Choose the right request profile and understand what happened during it.'],
                ['route' => 'docs.local-environments', 'label' => 'Local environments', 'description' => 'Keep Laravel web requests, MCP commands, containers, and queue workers aligned on the correct PHP runtime, environment, and profile storage.'],
                ['route' => 'docs.switching-from-laravel-debugbar', 'label' => 'Switch from Laravel Debugbar', 'description' => 'Plan a practical switch from Laravel Debugbar to The New Debug Bar by checking requirements, existing helper calls, storage, source actions, and agent workflows.'],
            ],
        ],
        [
            'label' => 'Troubleshooting',
            'pages' => [
                ['route' => 'docs.troubleshooting', 'label' => 'Troubleshooting', 'description' => 'Fix a missing Laravel debug bar, an MCP connection problem, or missing request profiles with focused checks and a visible result.'],
                ['route' => 'docs.troubleshooting.bar-not-showing', 'label' => 'The bar will not open', 'description' => 'Diagnose missing toolbar injection, disabled profiling, JSON responses, asset failures, and Livewire startup errors in a Laravel app.'],
                ['route' => 'docs.troubleshooting.mcp', 'label' => 'MCP connection problems', 'description' => 'Diagnose PHP paths, wrong Laravel applications, startup errors, missing MCP tools, and an empty profile list.'],
                ['route' => 'docs.troubleshooting.missing-profiles', 'label' => 'Missing profiles and data', 'description' => 'Find a missing Laravel request profile and distinguish retention, current-page discovery, capture limits, MCP pagination, and live-only evidence.'],
            ],
        ],
        [
            'label' => 'Use with agents',
            'pages' => [
                ['route' => 'docs.mcp', 'label' => 'MCP setup', 'description' => 'Give a local coding agent bounded access to exact saved request profiles.'],
                ['route' => 'docs.debugging-with-agents', 'label' => 'Debug with an agent', 'description' => 'Use The New Debug Bar MCP server to take a Laravel N+1 problem from an exact request profile to a code change and verification.'],
            ],
        ],
        [
            'label' => 'Debugging workflows',
            'pages' => [
                ['route' => 'docs.queries', 'label' => 'Queries', 'description' => 'Find slow, repeated, and likely N+1 queries, then trace them to application code.'],
                ['route' => 'docs.performance', 'label' => 'Performance', 'description' => 'Use duration, query time, memory, and the timeline to locate expensive work.'],
                ['route' => 'docs.livewire', 'label' => 'Livewire', 'description' => 'Inspect Livewire requests, mounted components, updates, and related browser activity.'],
                ['route' => 'docs.errors-and-logs', 'label' => 'Errors and logs', 'description' => 'Follow exceptions and log messages back to the code and context that produced them.'],
                ['route' => 'docs.artisan', 'label' => 'Artisan commands', 'description' => 'Inspect Laravel Artisan command profiles, exit codes, queries, logs, and failures through The New Debug Bar local MCP server.'],
            ],
        ],
        [
            'label' => 'Framework activity',
            'pages' => [
                ['route' => 'docs.eloquent', 'label' => 'Eloquent', 'description' => 'Review model retrievals, writes, repeated work, and the queries behind them.'],
                ['route' => 'docs.views', 'label' => 'Blade views', 'description' => 'Inspect Blade view occurrences, original template sources, registered composers, and retained view data with The New Debug Bar.'],
                ['route' => 'docs.events', 'label' => 'Events and listeners', 'description' => 'Find dispatch sources, repeated Laravel events, listener registrations, duplicate listeners, and related queued activity.'],
                ['route' => 'docs.authorization', 'label' => 'Authorization', 'description' => 'Trace a Laravel authorization decision to its ability, user, arguments, policy or Gate handler, and application source.'],
                ['route' => 'docs.validation', 'label' => 'Validation', 'description' => 'Inspect Laravel and Livewire validation failures, error bags, failed fields, messages, rules, source, and the selected response.'],
                ['route' => 'docs.http-client', 'label' => 'HTTP client', 'description' => 'Inspect outbound Laravel HTTP requests, responses, timing, and failures.'],
                ['route' => 'docs.queues', 'label' => 'Queues', 'description' => 'See which jobs were dispatched, where they were sent, and what triggered them.'],
                ['route' => 'docs.mail-and-notifications', 'label' => 'Mail and notifications', 'description' => 'Preview mail and inspect notification recipients, channels, payloads, and failures.'],
                ['route' => 'docs.cache-and-redis', 'label' => 'Cache and Redis', 'description' => 'Understand cache results and direct Redis commands without losing their source.'],
            ],
        ],
        [
            'label' => 'Reference',
            'pages' => [
                ['route' => 'docs.inspectors', 'label' => 'Inspectors', 'description' => 'See what each inspector captures and when to use it.'],
                ['route' => 'docs.configuration', 'label' => 'Configuration', 'description' => 'Change environments, thresholds, retention, and capture limits only when needed.'],
                ['route' => 'docs.data-and-privacy', 'label' => 'Data and privacy', 'description' => 'Understand local profile storage, retention, capture limits, and redaction controls.'],
                ['route' => 'docs.testing', 'label' => 'Testing', 'description' => 'Turn saved profiles into focused Pest assertions for performance and correctness.'],
                ['route' => 'docs.mcp-tools', 'label' => 'MCP tool reference', 'description' => 'Reference the five MCP tools in The New Debug Bar, including arguments, defaults, filters, response limits, JSON Pointer paths, and error states.'],
            ],
        ],
    ],
];
