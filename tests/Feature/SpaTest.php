<?php

namespace Tests\Feature;

use App\Beer;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Can access the homepage
     *
     * @return void
     */
    public function testCanAccessHome()
    {
        $this->get('/')->assertStatus(200);
    }

    /**
     * Can access the beer list
     *
     * @return void
     */
    public function testCanAccessBeerList()
    {
        $this->get('/beers')->assertStatus(200);
    }

    /**
     * Can access the beer detail
     *
     * @return void
     */
    public function testCanAccessBeerDetail()
    {
        $beer = factory(Beer::class)->create();

        $this->get('/beers/' . $beer->id)->assertStatus(200);
    }
}
