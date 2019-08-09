<?php

namespace App\Http\Controllers\V2;

use App\Artwork;
use App\Http\Resources\V2\Artwork as ArtworkResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class ArtworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        return Cache::remember('v2.artworks.' . $page, now()->addMonths(1),
            function () {
                return ArtworkResource::collection(Artwork::paginate(100));
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
