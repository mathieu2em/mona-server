<?php

namespace App\Http\Controllers\V1;

use App\Artwork;
use App\Http\Resources\V1\Artwork as ArtworkResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

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
        return ArtworkResource::collection(Artwork::all());
    }
}
