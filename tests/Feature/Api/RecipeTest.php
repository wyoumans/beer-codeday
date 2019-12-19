<?php

namespace Tests\Feature\Api;

use App\Recipe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RecipeTest extends TestCase
{
    use RefreshDatabase;

    public function testCanFetchAllRecipes()
    {
        factory(Recipe::class, 10)->create();

        $recipeCount = Recipe::count();

        $this
            ->json('GET', '/api/recipes')
            ->assertSuccessful()
            ->assertJsonCount($recipeCount, 'data');
    }

    public function testCanFetchASingleRecipe()
    {
        $recipe = factory(Recipe::class)->create();

        $this
            ->json('GET', '/api/recipes/' . $recipe->id)
            ->assertSuccessful()
            ->assertJson([
                'data' => [
                    'id' => $recipe->id,
                    'edamam_id' => $recipe->edamam_id,
                ],
            ]);
    }

    public function testShould404ForMissingRecipe()
    {
        $this
            ->json('GET', '/api/recipes/1234567890')
            ->assertStatus(404);
    }
}
