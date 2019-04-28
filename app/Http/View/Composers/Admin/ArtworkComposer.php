<?php

namespace App\Http\View\Composers\Admin;

use App\Artwork;
use App\Http\Resources\V2\Artwork as ArtworkResource;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

class ArtworkComposer
{
    /**
     * TODO.
     *
     * @var TODO
     */
    protected $artworks;

    /**
     * Create a new artwork composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->artworks = ArtworkResource::collection(
            Cache::remember('admin.artworks', now()->addHours(1), function () {
                return Artwork::all();
            }));
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('artworks', $this->artworks->toJson());
    }
}
