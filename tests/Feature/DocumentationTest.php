<?php

use function Pest\Laravel\get;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

dataset('documentation guides', function (): array {
    $configuration = require __DIR__.'/../../config/docs.php';
    $routes = ['Documentation' => ['docs.index']];

    foreach ($configuration['navigation'] as $group) {
        foreach ($group['pages'] as $page) {
            $routes[$page['label']] = [$page['route']];
        }
    }

    return $routes;
});

it('provides a complete illustrated guide with working page anchors and copyable examples', function (string $route) {
    $response = get(route($route, absolute: false))->assertOk();
    $previous = libxml_use_internal_errors(true);
    $document = new DOMDocument;
    $document->loadHTML($response->getContent());
    libxml_clear_errors();
    libxml_use_internal_errors($previous);
    $xpath = new DOMXPath($document);

    expect($xpath->query('//main//article//h1'))->toHaveCount(1)
        ->and($xpath->query('//main//article//*[@data-docs-figure]')->length)->toBeGreaterThan(0)
        ->and($xpath->query('//link[@rel="canonical"]')->item(0)?->getAttribute('href'))->toBe(route($route));

    foreach ($xpath->query('//main//article//*[@data-docs-figure]') as $figure) {
        expect(trim($figure->getElementsByTagName('figcaption')->item(0)?->textContent ?? ''))->not->toBe('');
    }

    foreach ($xpath->query('//main//a[starts-with(@href, "#")]') as $anchor) {
        $identifier = substr($anchor->getAttribute('href'), 1);

        expect($document->getElementById($identifier))->not->toBeNull();
    }

    foreach ($xpath->query('//main//article//*[@data-copy-root]') as $control) {
        $button = $xpath->query('.//button[@data-copy-command]', $control)->item(0);
        $code = $control->getElementsByTagName('code')->item(0);

        expect($button)->not->toBeNull()
            ->and($code)->not->toBeNull()
            ->and($button->getAttribute('data-copy-command'))->toBe($code->textContent);
    }

    foreach ($xpath->query('//main//article//*[@data-docs-screenshot]') as $screenshot) {
        $name = $screenshot->getAttribute('data-docs-screenshot');
        $theme = $screenshot->getAttribute('data-docs-screenshot-theme');
        $image = $screenshot->getElementsByTagName('img')->item(0);

        expect($theme)->toBeIn(['light', 'dark'])
            ->and($image?->getAttribute('alt'))->not->toBe('');

        foreach (['desktop', 'mobile'] as $viewport) {
            $path = resource_path("images/screenshots/docs/{$name}-{$viewport}-{$theme}.png");
            $size = getimagesize($path);
            $width = $viewport === 'desktop' ? 1536 : 402;
            $height = $viewport === 'desktop' ? 780 : 717;

            expect($size)->not->toBeFalse()
                ->and($size[2])->toBe(IMAGETYPE_PNG)
                ->and($size[0])->toBeGreaterThanOrEqual($width)
                ->and($size[0] * $height)->toBe($size[1] * $width);
        }
    }
})->with('documentation guides');
