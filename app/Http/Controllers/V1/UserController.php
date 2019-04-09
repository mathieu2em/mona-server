<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
            'IDOeuvre' => ['required', 'integer'],
            'note' => ['integer', 'max:5'],
            'comment' => ['string', 'max:2048'],
            'file' => ['image', 'max:4096'],
        ]);
    }

    /**
     * XXX.
     *
     * @param  Request  $data
     * @return array
     */
    public function verify(Request $request)
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

        return [
            'successful' => true,
            'erreur' => null,
        ];
    }

    /**
     * Store a newly created rating in storage.
     *
     * @param  Request  $request
     * @return array
     */
    public function rate(Request $request)
    {
        $status = $this->verify($request);
        if (!$status['successful']) {
            return $status;
        }

        /* XXX */
        if ($request->note) {
            Auth::user()->artworks()->syncWithoutDetaching([
                $request->IDOeuvre => ['rating' => $request->note],
            ]);
        }

        return $status;
    }

    /**
     * Store a newly created comment in storage.
     *
     * @param  Request  $request
     * @return array
     */
    public function comment(Request $request)
    {
        $status = $this->verify($request);
        if (!$status['successful']) {
            return $status;
        }

        /* XXX */
        if ($request->comment) {
            Auth::user()->artworks()->syncWithoutDetaching([
                $request->IDOeuvre => ['comment' => $request->comment],
            ]);
        }

        return $status;
    }

    /**
     * Store a newly created photo in storage.
     *
     * @param  Request  $request
     * @return array
     */
    public function photograph(Request $request)
    {
        $status = $this->verify($request);
        if (!$status['successful']) {
            return $status;
        }

        /* XXX */
        if ($request->file('file')) {
            Auth::user()->artworks()->syncWithoutDetaching([
                $request->IDOeuvre => [
                    'photo' => $request->file('file')->store('public/photos')
                ],
            ]);
        }

        return $status;
    }
}
