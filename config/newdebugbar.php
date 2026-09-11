<?php

$installationCommand = 'composer require --dev newdebugbar/newdebugbar:dev-main';

return [
    'installation' => [
        'command' => $installationCommand,
        'dependency_check' => $installationCommand.' --dry-run',
        'constraint' => 'dev-main',
        'minimum_livewire' => '4.4.3',
        'prerelease' => true,
    ],
];
