<?php

return [
    'navigation' => [
        [
            'label' => 'Getting started',
            'pages' => [
                [
                    'route' => 'docs.installation',
                    'label' => 'Installation',
                    'description' => 'Install the package and confirm the bar appears in your Laravel app.',
                ],
                [
                    'route' => 'docs.requests',
                    'label' => 'Requests',
                    'description' => 'Choose the right request profile and understand what happened during it.',
                ],
                [
                    'route' => 'docs.configuration',
                    'label' => 'Configuration',
                    'description' => 'Change environments, thresholds, retention, and capture limits only when needed.',
                ],
            ],
        ],
        [
            'label' => 'Use with agents',
            'pages' => [
                [
                    'route' => 'docs.mcp',
                    'label' => 'MCP setup',
                    'description' => 'Give a local coding agent bounded access to exact saved request profiles.',
                ],
            ],
        ],
        [
            'label' => 'Debugging workflows',
            'pages' => [
                [
                    'route' => 'docs.queries',
                    'label' => 'Queries',
                    'description' => 'Find slow, repeated, and likely N+1 queries, then trace them to application code.',
                ],
                [
                    'route' => 'docs.performance',
                    'label' => 'Performance',
                    'description' => 'Use duration, query time, memory, and the timeline to locate expensive work.',
                ],
                [
                    'route' => 'docs.errors-and-logs',
                    'label' => 'Errors and logs',
                    'description' => 'Follow exceptions and log messages back to the code and context that produced them.',
                ],
            ],
        ],
        [
            'label' => 'Laravel ecosystem',
            'pages' => [
                [
                    'route' => 'docs.livewire',
                    'label' => 'Livewire',
                    'description' => 'Inspect Livewire requests, mounted components, updates, and related browser activity.',
                ],
            ],
        ],
        [
            'label' => 'Framework activity',
            'pages' => [
                [
                    'route' => 'docs.eloquent',
                    'label' => 'Eloquent',
                    'description' => 'Review model retrievals, writes, repeated work, and the queries behind them.',
                ],
                [
                    'route' => 'docs.http-client',
                    'label' => 'HTTP client',
                    'description' => 'Inspect outbound Laravel HTTP requests, responses, timing, and failures.',
                ],
                [
                    'route' => 'docs.queues',
                    'label' => 'Queues',
                    'description' => 'See which jobs were dispatched, where they were sent, and what triggered them.',
                ],
                [
                    'route' => 'docs.mail-and-notifications',
                    'label' => 'Mail and notifications',
                    'description' => 'Preview mail and inspect notification recipients, channels, payloads, and failures.',
                ],
                [
                    'route' => 'docs.cache-and-redis',
                    'label' => 'Cache and Redis',
                    'description' => 'Understand cache results and direct Redis commands without losing their source.',
                ],
            ],
        ],
        [
            'label' => 'Reference',
            'pages' => [
                [
                    'route' => 'docs.inspectors',
                    'label' => 'Inspector sections',
                    'description' => 'See what every inspector captures and when each section is useful.',
                ],
                [
                    'route' => 'docs.data-and-privacy',
                    'label' => 'Data and privacy',
                    'description' => 'Understand local profile storage, retention, capture limits, and redaction controls.',
                ],
                [
                    'route' => 'docs.testing',
                    'label' => 'Testing',
                    'description' => 'Turn saved profiles into focused Pest assertions for performance and correctness.',
                ],
            ],
        ],
    ],
];
