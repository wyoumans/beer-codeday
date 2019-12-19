<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
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
            'edamam_id' => $this->edamam_id,
            'url' => $this->url,
            'label' => $this->label,
            'source' => $this->source,
            'image_url' => $this->image_url,
            'share_url' => $this->share_url,
        ];
    }
}
