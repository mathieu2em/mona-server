<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Artwork extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'produced_at' => $this->produced_at,
            'category' => $this->category,
            'subcategory' => $this->subcategory,
            'dimensions' => $this->dimensions,
            'materials' => $this->materials,
            'techniques' => $this->techniques,
            'artists' => $this->artists,
            'borough' => $this->borough,
            'location' => $this->location,
        ];
    }
}
