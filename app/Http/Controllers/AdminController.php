<?php

namespace App\Http\Controllers;

use App\Artwork;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    /**
     * Show the application administration dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function artworks()
    {
        return view('admin.artworks')->with('artworks', Artwork::all());
    }

    /**
     * Show the application administration dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function users()
    {
        return view('admin.users')->with('users', User::all());
    }
}
