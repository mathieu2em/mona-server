<?php

namespace App\Http\Controllers\V2;

use App\Artist;
use App\Http\Resources\V2\Artist as ArtistResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class ArtistController extends Controller
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
        return Cache::remember('v2.artists.' . $page, now()->addMonths(1),
            function () {
                return ArtistResource::collection(Artist::paginate(100));
            });
    }

    /**
     * Display the specified resource.
     *
     * @param  Artist  $artist
     * @return ArtistResource
     */
    public function show(Artist $artist)
    {
        return new ArtistResource($artist);
    }
}
