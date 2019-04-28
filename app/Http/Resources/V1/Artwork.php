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
     * TODO.
     *
     * @param  array  $dimensions
     * @return string
     */
    public function toStringDimensions($dimensions)
    {
        $last = array_pop($dimensions);
        if (!$dimensions) {
            return $last;
        }
        return join(' x ', $dimensions) . (strpos($last, 'm') !== false ? ' ' : ' x ') . $last;
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
            'SousCategorie' => $this->subcategory->fr ?? null,
            'SousCategorieANG' => $this->subcategory->en ?? null,
            'Date' => $this->toMicrosoftDateFormat($this->produced_at),
            'Materiaux' => $this->materials->isEmpty() ? null : MultiLanguageResource::collection($this->materials),
            'Technique' => $this->techniques->isEmpty() ? null : MultiLanguageResource::collection($this->techniques),
            'Dimension' => empty($this->dimensions) ? null : $this->toStringDimensions($this->dimensions),
            'Arrondissement' => $this->borough->name,
            'Latitude' => $this->location->lat,
            'Longitude' => $this->location->lng,
            'Artiste' => $this->artists->isEmpty() ? null : ArtistResource::collection($this->artists),
        ];
    }
}
