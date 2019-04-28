<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            'admin.artworks', 'App\Http\View\Composers\Admin\ArtworkComposer'
        );

        View::composer(
            'admin.users', 'App\Http\View\Composers\Admin\UserComposer'
        );
    }
}
