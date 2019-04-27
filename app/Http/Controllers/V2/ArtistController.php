<?php

namespace App\Http\Controllers\V2;

use App\Artist;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Artist[]|Collection
     */
    public function index()
    {
        return Cache::remember('artists', now()->addMonths(1), function () {
            return Artist::all();
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  Artist  $artist
     * @return Artist
     */
    public function show(Artist $artist)
    {
        return $artist;
    }
}
