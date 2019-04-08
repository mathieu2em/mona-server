<?php

namespace App\Http\Resources\V1;

use App\Http\Resources\V1\Artist as ArtistResource;
use App\Http\Resources\V1\MultiLanguage as MultiLanguageResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Artwork extends JsonResource
{
    /**
     * Transform the date into the Microsoft format.
     *
     * @param  string  $date
     * @return string
     */
    public function toMicrosoftDateFormat($date)
    {
        return sprintf('/Date(%d000+0000)/', strtotime($date)); // XXX
    }

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
            'Titre' => $this->title,
            'Categorie' => $this->category->fr,
            'CategorieANG' => $this->category->en,
            'SousCategorie' => $this->subcategory->fr,
            'SousCategorieANG' => $this->subcategory->en,
            'Date' => $this->toMicrosoftDateFormat($this->produced_at),
            'Materiaux' => MultiLanguageResource::collection($this->materials),
            'Technique' => MultiLanguageResource::collection($this->techniques),
            'Dimension' => $this->dimensions, // XXX
            'Arrondissement' => $this->borough->name,
            'Latitude' => $this->location->lat,
            'Longitude' => $this->location->lng,
            'Artiste' => ArtistResource::collection($this->artists),
        ];
    }
}
