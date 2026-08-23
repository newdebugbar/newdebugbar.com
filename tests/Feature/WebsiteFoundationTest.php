<?php

namespace Tests\Feature;

use Tests\TestCase;

class WebsiteFoundationTest extends TestCase
{
    public function test_the_landing_page_introduces_the_product(): void
    {
        $this->withoutVite();

        $this->get('/')
            ->assertOk()
            ->assertSee('Powerful, agent-friendly Laravel debugging—free and open source')
            ->assertSee('Explore requests, queries, exceptions, and application activity with clear explanations of what happened and what to check next. Coding agents get the same structured context through MCP with fewer tokens.')
            ->assertSee('composer require newdebugbar/newdebugbar:dev-main --dev')
            ->assertSee('Built for AI-pilled developers')
            ->assertSee('https://github.com/newdebugbar/newdebugbar#readme', false)
            ->assertSee('data-theme-toggle', false)
            ->assertSee('data-hero-mobile-source', false)
            ->assertDontSee('LOCAL · READ-ONLY AGENT ACCESS');
    }

    public function test_the_hero_has_desktop_and_mobile_captures_for_both_themes(): void
    {
        $captures = [
            'inspector-desktop-dark.png' => [1536, 780],
            'inspector-desktop-light.png' => [1536, 780],
            'inspector-mobile-dark.png' => [780, 1386],
            'inspector-mobile-light.png' => [780, 1386],
        ];

        foreach ($captures as $capture => $expectedDimensions) {
            $path = resource_path("images/hero/{$capture}");

            $this->assertFileExists($path);
            $this->assertSame($expectedDimensions, array_slice(getimagesize($path), 0, 2));
            $this->assertSame(6, ord(file_get_contents($path, false, null, 25, 1)), "{$capture} must use RGBA pixels.");

            $image = imagecreatefrompng($path);

            $this->assertNotFalse($image);

            foreach ([[0, 0], [$expectedDimensions[0] - 1, 0], [3, 3], [$expectedDimensions[0] - 4, 3]] as [$x, $y]) {
                $alpha = (imagecolorat($image, $x, $y) >> 24) & 0x7F;

                $this->assertSame(127, $alpha, "{$capture} must have transparent rounded corners.");
            }
        }
    }
}
