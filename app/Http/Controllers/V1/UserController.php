<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'file' => ['image', 'max:4096'],
        ]);
    }

    /**
     * Store a newly created rating in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function rate(Request $request)
    {
        if (! Auth::once($request->only('username', 'password'))) {
            return [
                'successful' => false,
                'erreur' => trans('auth.failed'),
            ];
        }

        Auth::user()->artworks()->syncWithoutDetaching([
            $request->IDOeuvre => ['rating' => $request->note],
        ]);

        return [
            'successful' => true,
            'erreur' => null,
        ];
    }

    /**
     * Store a newly created comment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function comment(Request $request)
    {
        if (! Auth::once($request->only('username', 'password'))) {
            return [
                'successful' => false,
                'erreur' => trans('auth.failed'),
            ];
        }

        Auth::user()->artworks()->syncWithoutDetaching([
            $request->IDOeuvre => ['comment' => $request->comment],
        ]);

        return [
            'successful' => true,
            'erreur' => null,
        ];
    }

    /**
     * Store a newly created photo in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function photograph(Request $request)
    {
        if (! Auth::once($request->only('username', 'password'))) {
            return [
                'successful' => false,
                'erreur' => trans('auth.failed'),
            ];
        }

        if (($validator = $this->validator($request->all()))->fails()) {
            return [
                'successful' => false,
                'erreur' => $validator->errors()->first(),
            ];
        }

        Auth::user()->artworks()->syncWithoutDetaching([
            $request->IDOeuvre => [
                'photo' => $request->file('file')->store('photos')
            ],
        ]);

        return [
            'successful' => true,
            'erreur' => null,
        ];
    }
}
