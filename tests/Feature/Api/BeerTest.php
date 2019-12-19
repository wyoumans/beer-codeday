<?php

namespace Tests\Feature\Api;

use App\Beer;
use App\Recipe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BeerTest extends TestCase
{
    use RefreshDatabase;

    public function testCanFetchAllBeers()
    {
        factory(Beer::class, 10)->create();

        $beerCount = Beer::count();

        $this
            ->json('GET', '/api/beers')
            ->assertSuccessful()
            ->assertJsonCount($beerCount, 'data');
    }

    public function testCanFetchASingleBeer()
    {
        $beer = factory(Beer::class)->create();
        $recipes = factory(Recipe::class, 2)->create();
        $beer->recipes()->sync($recipes->pluck('id')->all());

        $this
            ->json('GET', '/api/beers/' . $beer->id)
            ->assertSuccessful()
            ->assertJson([
                'data' => [
                    'id' => $beer->id,
                    'punk_id' => $beer->punk_id,
                    'recipes' => $recipes->map(function ($recipe) {
                        return [
                            'id' => $recipe->id,
                            'edamam_id' => $recipe->edamam_id,
                        ];
                    })->toArray(),
                ],
            ]);
    }

    public function testShould404ForMissingBeer()
    {
        $this
            ->json('GET', '/api/beers/1234567890')
            ->assertStatus(404);
    }

    // public function testCanFetchARandomBeer()
    // {
    //     $beer = factory(Beer::class)->create();

    //     $this
    //         ->json('GET', '/api/beers/random')
    //         ->assertSuccessful()
    //         ->assertJson([
    //             'data' => [
    //                 'id' => $beer->id,
    //                 'name' => $beer->name,
    //             ],
    //         ]);
    // }
}
