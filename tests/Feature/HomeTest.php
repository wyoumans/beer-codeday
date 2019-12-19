<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * Can access the homepage
     *
     * @return void
     */
    public function testCanAccessHome()
    {
        $this->get('/')->assertStatus(200);
    }
}
