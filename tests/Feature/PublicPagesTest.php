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
    'documentation home' => ['/docs', 'docs.index'],
    'installation page' => ['/docs/installation', 'docs.installation'],
    'requests page' => ['/docs/requests', 'docs.requests'],
    'configuration page' => ['/docs/configuration', 'docs.configuration'],
    'queries page' => ['/docs/queries', 'docs.queries'],
    'performance page' => ['/docs/performance', 'docs.performance'],
    'Livewire page' => ['/docs/livewire', 'docs.livewire'],
    'data and privacy page' => ['/docs/data-and-privacy', 'docs.data-and-privacy'],
    'inspector sections page' => ['/docs/inspectors', 'docs.inspectors'],
    'Eloquent page' => ['/docs/eloquent', 'docs.eloquent'],
    'errors and logs page' => ['/docs/errors-and-logs', 'docs.errors-and-logs'],
    'HTTP client page' => ['/docs/http-client', 'docs.http-client'],
    'queues page' => ['/docs/queues', 'docs.queues'],
    'mail and notifications page' => ['/docs/mail-and-notifications', 'docs.mail-and-notifications'],
    'cache and Redis page' => ['/docs/cache-and-redis', 'docs.cache-and-redis'],
    'testing page' => ['/docs/testing', 'docs.testing'],
    'MCP setup page' => ['/docs/mcp', 'docs.mcp'],
]);

it('keeps documentation routes unversioned', function (string $route, string $uri) {
    expect(route($route, absolute: false))->toBe($uri);
})->with([
    'documentation home' => ['docs.index', '/docs'],
    'installation page' => ['docs.installation', '/docs/installation'],
    'requests page' => ['docs.requests', '/docs/requests'],
    'configuration page' => ['docs.configuration', '/docs/configuration'],
    'queries page' => ['docs.queries', '/docs/queries'],
    'performance page' => ['docs.performance', '/docs/performance'],
    'Livewire page' => ['docs.livewire', '/docs/livewire'],
    'data and privacy page' => ['docs.data-and-privacy', '/docs/data-and-privacy'],
    'inspector sections page' => ['docs.inspectors', '/docs/inspectors'],
    'Eloquent page' => ['docs.eloquent', '/docs/eloquent'],
    'errors and logs page' => ['docs.errors-and-logs', '/docs/errors-and-logs'],
    'HTTP client page' => ['docs.http-client', '/docs/http-client'],
    'queues page' => ['docs.queues', '/docs/queues'],
    'mail and notifications page' => ['docs.mail-and-notifications', '/docs/mail-and-notifications'],
    'cache and Redis page' => ['docs.cache-and-redis', '/docs/cache-and-redis'],
    'testing page' => ['docs.testing', '/docs/testing'],
    'MCP setup page' => ['docs.mcp', '/docs/mcp'],
]);

it('publishes every public documentation route through the XML sitemap', function () {
    $documentationRoutes = collect(config('docs.navigation'))
        ->flatMap(fn (array $group): array => $group['pages'])
        ->pluck('route')
        ->prepend('docs.index');

    get('/sitemap.xml')
        ->assertOk()
        ->assertHeader('Content-Type', 'application/xml; charset=UTF-8')
        ->assertViewIs('sitemap')
        ->assertViewHas('urls', function (array $urls) use ($documentationRoutes): bool {
            return $documentationRoutes->every(
                fn (string $route): bool => in_array(route($route), $urls, true),
            );
        });
});
