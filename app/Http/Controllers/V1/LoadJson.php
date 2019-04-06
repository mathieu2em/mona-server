<?php

namespace App\Http\Controllers\V1;

use App\Artwork;
use App\Http\Resources\V1\Artwork as ArtworkResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoadJson extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return ArtworkResource::collection(Artwork::all());
    }
}
