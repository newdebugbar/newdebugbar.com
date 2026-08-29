<?php

use function Pest\Laravel\get;

beforeEach(function () {
    $this->withoutVite();
});

it('serves a public page through its intended view', function (string $uri, string $view) {
    get($uri)
        ->assertOk()
        ->assertViewIs($view);
})->with([
    'landing page' => ['/', 'welcome'],
    'installation page' => ['/docs/installation', 'docs.installation'],
]);

it('keeps the installation route unversioned', function () {
    expect(route('docs.installation', absolute: false))
        ->toBe('/docs/installation');
});
