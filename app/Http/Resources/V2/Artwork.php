<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

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
            'borough' => $this->borough->name ?? null,
            'location' => $this->location,
            'collection' => $this->collection->name ?? null,
            'details' => $this->details,
            $this->mergeWhen(Auth::user() && Auth::user()->isAdmin(), [
                'ratings' => $this->users->map(function ($item) {
                    return $item->pivot->rating;
                })->reject(function ($value) {
                    return $value === null;
                }),
                'comments' => $this->users->map(function ($item) {
                    return $item->pivot->comment;
                })->reject(function ($value) {
                    return $value == null;
                }),
                'photos' => $this->users->map(function ($item) {
                    return $item->pivot->photo;
                })->reject(function ($value) {
                    return $value == null;
                }),
            ]),
        ];
    }
}
