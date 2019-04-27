<?php

namespace App\Http\Controllers;

use App\User;
use App\Artwork;
use App\Http\Resources\V2\Artwork as ArtworkResource;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the application administration dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function artworks()
    {
        $artworks = ArtworkResource::collection(Artwork::all());
        return view('admin.artworks')->with('artworks', $artworks->toJson());
    }

    /**
     * Show the application administration dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function users()
    {
        $users = UserResource::collection(User::all());
        return view('admin.users')->with('users', $users->toJson());
    }
}
