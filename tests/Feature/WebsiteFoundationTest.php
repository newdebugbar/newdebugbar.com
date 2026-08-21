<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * Confirms the temporary Laravel landing screen remains reachable while the site is designed.
 */
class WebsiteFoundationTest extends TestCase
{
    public function test_the_site_is_reachable(): void
    {
        $this->get('/')->assertOk();
    }
}
