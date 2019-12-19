<?php

namespace App\Console\Commands;

use App\Beer;
use App\Pairing;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class FetchBeers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch-beers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and cache beers';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line(PHP_EOL . 'Fetching the beer list' . PHP_EOL);

        $page = $count = 0;
        $maxPages = 200; // prevent runaway

        do {
            // fetch the next page of beers
            $beers = $this->fetchPage(++$page);

            $beers->each(function($beer) {
                // create or update the local cache
                $localBeer = Beer::updateOrCreate([
                    'punk_id' => $beer->id,
                ], [
                    'name' => $beer->name,
                    'tagline' => $beer->tagline,
                    'description' => $beer->description,
                    'image_url' => $beer->image_url,
                    'abv' => $beer->abv,
                ]);

                // create the pairing association
                if(is_array($beer->food_pairing)) {
                    $pairingIds = [];
                    foreach($beer->food_pairing as $pairing) {
                        $localPairing = Pairing::firstOrCreate([
                            'name' => $pairing
                        ]);
                        $pairingIds[] = $localPairing->id;
                    }

                    // We want to remove any old pairings that no longer exist using sync
                    $localBeer->pairings()->sync($pairingIds);
                }
            });

            // keep a tally
            $count += $beers->count();
        } while($beers->count() > 0 && $page < $maxPages);

        $this->line(PHP_EOL . "Complete. $count beers fetched." . PHP_EOL);
    }

    /**
     * helper for making GET requests.
     *
     * @param string $url
     * @param array $params
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    private function getData($url, $params = [])
    {
        // establish a Guzzle Client
        $client = new Client([
            'base_uri' => config('punkapi.url_base')
        ]);

        // set the headers
        $headers = [
            'Accept' => 'application/json',
        ];

        // append any URL params
        $url .= '?' . http_build_query($params);

        return $client->get($url, [
            'headers' => $headers,
            'http_errors' => false,
            'exceptions'  => false,
        ]);
    }

    /**
     * Fetch the given page of beers
     *
     * @param integer $page
     *
     * @return Collection
     */
    private function fetchPage($page = 0) {
        // Fetch the beers list
        $response = $this->getData('beers', [
            'page' => $page
        ]);

        try {
            $code = $response->getStatusCode();
            $json = json_decode($response->getBody());

            // Stop execution if we did not get the okay from the server
            if ($code !== 200) {
                throw new \Exception("$code response received from the server");
            }

            return collect($json);

        } catch(\Exception $e) {
            $this->error($e->getMessage());
        }

        return null;
    }
}
