<?php

namespace Tests\Feature\Pages;

use Tests\TestCase;

class HomepageTest extends TestCase
{
    public function test_it_renders_homepage(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Santa Claus Christian Church');
    }
}
