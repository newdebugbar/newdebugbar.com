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

it('exposes every configured documentation route in the mobile menu', function () {
    $response = get('/docs/queries')->assertOk();
    $expectedUrls = collect(config('docs.navigation'))
        ->flatMap(fn (array $group): array => $group['pages'])
        ->map(fn (array $page): string => route($page['route']))
        ->values()
        ->all();

    $previousErrorHandling = libxml_use_internal_errors(true);
    $document = new DOMDocument;
    $document->loadHTML($response->getContent());
    libxml_clear_errors();
    libxml_use_internal_errors($previousErrorHandling);

    $xpath = new DOMXPath($document);
    $mobileUrls = [];

    foreach ($xpath->query('//*[@data-mobile-docs-navigation]//a') as $link) {
        $mobileUrls[] = $link->getAttribute('href');
    }

    $currentLinks = $xpath->query('//*[@data-mobile-docs-navigation]//a[@aria-current="page"]');

    expect($mobileUrls)->toBe($expectedUrls)
        ->and($currentLinks)->toHaveCount(1)
        ->and($currentLinks->item(0)?->getAttribute('href'))->toBe(route('docs.queries'));
});

it('offers sponsorship and freelance paths on the landing page', function () {
    $response = get('/')->assertOk();

    $previousErrorHandling = libxml_use_internal_errors(true);
    $document = new DOMDocument;
    $document->loadHTML($response->getContent());
    libxml_clear_errors();
    libxml_use_internal_errors($previousErrorHandling);

    $xpath = new DOMXPath($document);
    $supportOptions = $xpath->query('//*[@data-support-options="featured"]');
    $sponsorLink = $xpath->query('//*[@data-support-options="featured"]//*[@data-support-option="sponsor"]');
    $hireLink = $xpath->query('//*[@data-support-options="featured"]//*[@data-support-option="hire"]');

    expect($supportOptions)->toHaveCount(1)
        ->and($sponsorLink)->toHaveCount(1)
        ->and($sponsorLink->item(0)?->getAttribute('href'))->toBe('https://github.com/sponsors/benjamincrozat')
        ->and($hireLink)->toHaveCount(1)
        ->and($hireLink->item(0)?->getAttribute('href'))->toBe('https://benjamincrozat.com');
});

it('shows the project roadmap after the support section', function () {
    $response = get('/')->assertOk();

    $previousErrorHandling = libxml_use_internal_errors(true);
    $document = new DOMDocument;
    $document->loadHTML($response->getContent());
    libxml_clear_errors();
    libxml_use_internal_errors($previousErrorHandling);

    $xpath = new DOMXPath($document);
    $roadmap = $xpath->query('//*[@data-project-roadmap]');
    $roadmapAfterSupport = $xpath->query('//*[@data-support-options="featured"]/following-sibling::*[@data-project-roadmap]');
    $roadmapItems = $xpath->query('//*[@data-project-roadmap]//*[@data-roadmap-item]');
    $roadmapSource = $xpath->query('//*[@data-project-roadmap]//*[@data-roadmap-source]');

    expect($roadmap)->toHaveCount(1)
        ->and($roadmapAfterSupport)->toHaveCount(1)
        ->and($roadmapItems)->toHaveCount(6)
        ->and($roadmapSource)->toHaveCount(1)
        ->and($roadmapSource->item(0)?->getAttribute('href'))->toBe('https://github.com/newdebugbar/newdebugbar/blob/main/ROADMAP.md');
});

it('publishes a dedicated social preview image', function () {
    $response = get('/')->assertOk();

    $previousErrorHandling = libxml_use_internal_errors(true);
    $document = new DOMDocument;
    $document->loadHTML($response->getContent());
    libxml_clear_errors();
    libxml_use_internal_errors($previousErrorHandling);

    $xpath = new DOMXPath($document);
    $ogImage = $xpath->query('//meta[@property="og:image"]');
    $ogImageType = $xpath->query('//meta[@property="og:image:type"]');
    $ogImageWidth = $xpath->query('//meta[@property="og:image:width"]');
    $ogImageHeight = $xpath->query('//meta[@property="og:image:height"]');
    $ogImageAlt = $xpath->query('//meta[@property="og:image:alt"]');
    $twitterImage = $xpath->query('//meta[@name="twitter:image"]');
    $twitterImageAlt = $xpath->query('//meta[@name="twitter:image:alt"]');

    expect($ogImage)->toHaveCount(1)
        ->and($ogImage->item(0)?->getAttribute('content'))->not->toBe('')
        ->and($ogImageType->item(0)?->getAttribute('content'))->toBe('image/png')
        ->and($ogImageWidth->item(0)?->getAttribute('content'))->toBe('1200')
        ->and($ogImageHeight->item(0)?->getAttribute('content'))->toBe('630')
        ->and($ogImageAlt->item(0)?->getAttribute('content'))->not->toBe('')
        ->and($twitterImage->item(0)?->getAttribute('content'))->toBe($ogImage->item(0)?->getAttribute('content'))
        ->and($twitterImageAlt->item(0)?->getAttribute('content'))->toBe($ogImageAlt->item(0)?->getAttribute('content'));
});

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
