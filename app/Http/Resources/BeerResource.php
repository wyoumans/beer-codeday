<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BeerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'punk_id' => (int) $this->punk_id,
            'name' => $this->name,
            'tagline' => $this->tagline,
            'description' => $this->description,
            'image_url' => $this->image_url,
            'abv' => $this->abv,
            'recipes' => $this->recipes ? new RecipeCollection($this->recipes) : [],
        ];
    }
}
