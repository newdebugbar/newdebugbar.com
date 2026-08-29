<?php

namespace Tests\Feature;

use Tests\TestCase;

class DocumentationInstallationTest extends TestCase
{
    public function test_the_installation_page_explains_the_current_setup(): void
    {
        $this->withoutVite();

        $response = $this->get('/docs/installation');

        $response
            ->assertOk()
            ->assertSee('<title>Install New Debug Bar in Laravel | New Debug Bar</title>', false)
            ->assertSee('rel="canonical" href="'.url('/docs/installation').'"', false)
            ->assertSee('Install New Debug Bar')
            ->assertSee('Laravel 10 or newer.')
            ->assertSee('PHP 8.1 or newer.')
            ->assertSee('composer require --dev newdebugbar/newdebugbar:dev-main')
            ->assertSee('New Debug Bar uses Livewire 4 for its own interface.')
            ->assertSee('php artisan vendor:publish --tag=newdebugbar-config')
            ->assertSee('NEWDEBUGBAR_ENABLED=false')
            ->assertSee('you do not need to register a service provider, run migrations, or publish frontend assets')
            ->assertSee('https://github.com/newdebugbar/newdebugbar/blob/main/docs/mcp.md', false)
            ->assertSee('aria-current="page"', false)
            ->assertSee('data-docs-shell', false)
            ->assertSee('data-docs-figure', false)
            ->assertSee('data-request-inspector-image', false)
            ->assertDontSee('/docs/v1/', false)
            ->assertDontSee('git@newdebugbar.com');

        $this->assertSame(3, substr_count($response->getContent(), 'data-docs-code-block'));
        $this->assertMatchesRegularExpression(
            '/<figure[^>]*data-docs-figure[^>]*>\s*<picture[^>]*data-request-inspector-screenshot/',
            $response->getContent(),
            'Product screenshots should not be wrapped in a decorative frame.',
        );
    }

    public function test_the_landing_page_links_to_the_installation_docs(): void
    {
        $this->withoutVite();

        $this->get('/')
            ->assertOk()
            ->assertSee(route('docs.installation'), false)
            ->assertDontSee('https://github.com/newdebugbar/newdebugbar#readme', false);
    }
}
