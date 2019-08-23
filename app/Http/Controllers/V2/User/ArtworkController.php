<?php

namespace App\Http\Controllers\V2\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ArtworkController extends Controller
{
    /**
     * Get a validator for an incoming request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            /* 'id' => ['required', 'integer'], */
            'rating' => ['integer', 'max:5'],
            'comment' => ['string', 'max:2048'],
            'photo' => ['image', 'max:4096'],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\ArtworkUser
     */
    public function index()
    {
        return Auth::user()->artworks->map(function ($item) {
            return $item->pivot;
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return void
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        $attrs = [];
        if ($rating = $request->rating)
            $attrs['rating'] = $rating;
        if ($comment = $request->comment)
            $attrs['comment'] = $comment;
        if ($photo = $request->file('photo'))
            $attrs['photo'] = $photo->store('public/photos');

        $artworks = Auth::user()->artworks();
        if ($artworks->find($request->id)) {
            $artworks->updateExistingPivot($request->id, $attrs);
        } else {
            $artworks->syncWithoutDetaching([$request->id => $attrs]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \App\ArtworkUser
     */
    public function show($id)
    {
        return Auth::user()->artworks()->find($id)->pivot;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $this->validator($request->all())->validate();

        $attrs = [];
        if ($rating = $request->rating)
            $attrs['rating'] = $rating;
        if ($comment = $request->comment)
            $attrs['comment'] = $comment;
        if ($photo = $request->file('photo'))
            $attrs['photo'] = $photo->store('public/photos');

        Auth::user()->artworks()->updateExistingPivot($id, $attrs);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return void
     */
    public function destroy($id)
    {
        Auth::user()->artworks()->detach($id);
    }
}
