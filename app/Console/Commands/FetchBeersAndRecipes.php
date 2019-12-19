<?php

namespace App\Console\Commands;

use App\Beer;
use App\Recipe;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class FetchBeersAndRecipes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and cache beers and recipes';

    /**
     * The guzzle client
     *
     * @var GuzzleHttp\Client
     */
    private $client;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line(PHP_EOL . 'Fetching the beer list' . PHP_EOL);

        // establish a guzzle client
        $this->setupClient();

        $page = $count = 0;
        $maxPages = 100; // prevent runaway

        do {
            // fetch the next page of beers
            $beers = $this->getPageOfBeers(++$page);

            $beers->each(function ($beer) {
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

                // because of the low API rate limit in Edamam, we only run the query if the
                // beer does not have any existing pairings
                if (is_array($beer->food_pairing) && $localBeer->recipes()->count() == 0) {
                    $recipeIds = [];
                    foreach ($beer->food_pairing as $pairing) {
                        $recipes = $this->getRecipes($pairing);

                        if ($recipes && $recipes->count()) {
                            $recipes->each(function ($recipe) use ($pairing, &$recipeIds) {
                                // Edamam does not include a useful id,
                                // so we'll create one by hashing the uri
                                $id = md5($recipe->uri);

                                $localRecipe = Recipe::firstOrCreate([
                                    'edamam_id' => $id
                                ], [
                                    'url' => $recipe->url,
                                    'label' => $recipe->label,
                                    'source' => $recipe->source,
                                    'image_url' => $recipe->image,
                                    'share_url' => $recipe->shareAs,
                                ]);

                                // establish the relationship with the pairing as the pivot name
                                $recipeIds[$localRecipe->id] = ['name' => $pairing];
                            });
                        }
                    }

                    // We want to remove any old pairings that no longer exist using sync
                    $localBeer->recipes()->sync($recipeIds);
                }
            });

            // keep a tally
            $count += $beers->count();
        } while ($beers->count() > 0 && $page < $maxPages);

        $this->line(PHP_EOL . "Complete. $count beers fetched." . PHP_EOL);
    }

    /**
     * helper for making GET requests.
     *
     * @param array $params
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    private function getBeers($params = [])
    {
        $url = config('punkapi.url_base') . 'beers';

        // append any URL params
        $url .= '?' . http_build_query($params);

        return $this->client->get($url);
    }

    /**
     * Fetch the given page of beers
     *
     * @param integer $page
     *
     * @return Collection
     */
    private function getPageOfBeers($page = 0)
    {
        // Fetch the beers list
        $response = $this->getBeers([
            'page' => $page
        ]);

        try {
            $code = $response->getStatusCode();
            $json = json_decode($response->getBody());

            // Stop execution if we did not get the okay from the server
            if ($code !== 200) {
                throw new \Exception("$code response received from the punk api server");
            }

            return collect($json);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

        return null;
    }

    /**
     * helper for making GET requests.
     *
     * @param string $search
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    private function getRecipes($search)
    {
        $url = config('edamam.url_base') . 'search';

        $params = [
            'q' => $search,
            'app_id' => config('edamam.app_id'),
            'app_key' => config('edamam.app_key'),
        ];

        // append any URL params
        $url .= '?' . http_build_query($params);

        $response = $this->client->get($url);

        try {
            $code = $response->getStatusCode();
            $json = json_decode($response->getBody());

            if ($code == 200 && property_exists($json, 'hits')) {
                return collect($json->hits)->map(function ($recipe) {
                    // right now, we only care about the actual recipe
                    return $recipe->recipe;
                });
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

        return null;
    }

    private function setupClient()
    {
        // set the headers
        $headers = [
            'Accept' => 'application/json',
        ];

        $this->client = new Client([
            'headers' => $headers,
            'http_errors' => false,
            'exceptions' => false,
        ]);
    }
}
