<?php

namespace App\Http\Controllers\V2;

use App\Artwork;
use App\Http\Resources\V2\Artwork as ArtworkResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class ArtworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return Cache::remember('v2.artworks', now()->addMonths(1),
            function () {
                return ArtworkResource::collection(Artwork::all());
            });
    }

    /**
     * Display the specified resource.
     *
     * @param  Artwork  $artwork
     * @return ArtworkResource
     */
    public function show(Artwork $artwork)
    {
        return new ArtworkResource($artwork);
    }
}
