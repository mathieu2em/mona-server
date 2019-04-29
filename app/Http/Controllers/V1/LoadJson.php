<?php

namespace App\Http\Controllers\V1;

use App\Artwork;
use App\Http\Resources\V1\Artwork as ArtworkResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class LoadJson extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @return AnonymousResourceCollection
     */
    public function __invoke(Request $request)
    {
        return Cache::remember('v1.artworks', now()->addMonths(1),
            function () {
                return ArtworkResource::collection(Artwork::all());
            });
    }
}
