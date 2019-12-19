<?php

namespace Tests\Feature\Api;

use App\Pairing;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PairingTest extends TestCase
{
    use RefreshDatabase;

    public function testCanFetchAllPairings()
    {
        factory(Pairing::class, 10)->create();

        $pairingCount = Pairing::count();

        $this
            ->json('GET', '/api/pairings')
            ->assertSuccessful()
            ->assertJsonCount($pairingCount, 'data');
    }

    public function testCanFetchASingleBeer()
    {
        $pairing = factory(Pairing::class)->create();

        $this
            ->json('GET', '/api/pairings/' . $pairing->id)
            ->assertSuccessful()
            ->assertJson([
                'data' => [
                    'id' => $pairing->id,
                    'name' => $pairing->name,
                ],
            ]);
    }

    public function testShould404ForMissingPairing()
    {
        $this
            ->json('GET', '/api/pairings/1234567890')
            ->assertStatus(404);
    }
}
