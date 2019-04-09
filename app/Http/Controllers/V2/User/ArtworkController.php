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

        $photo = $request->file('photo');
        Auth::user()->artworks()->syncWithoutDetaching([$request->id => [
            'rating' => $request->rating,
            'comment' => $request->comment,
            'photo' => $photo ? $photo->store('public/photos') : null,
        ]]);
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

        $photo = $request->file('photo');
        Auth::user()->artworks()->updateExistingPivot($id, [
            'rating' => $request->rating,
            'comment' => $request->comment,
            'photo' => $photo ? $photo->store('public/photos') : null,
        ]);
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
