<?php

use function Pest\Laravel\get;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('serves a public page through its intended view', function (string $uri, string $view) {
    get($uri)
        ->assertOk()
        ->assertViewIs($view);
})->with([
    'landing page' => ['/', 'welcome'],
    'installation page' => ['/docs/installation', 'docs.installation'],
    'MCP setup page' => ['/docs/mcp', 'docs.mcp'],
]);

it('keeps documentation routes unversioned', function (string $route, string $uri) {
    expect(route($route, absolute: false))->toBe($uri);
})->with([
    'installation page' => ['docs.installation', '/docs/installation'],
    'MCP setup page' => ['docs.mcp', '/docs/mcp'],
]);
