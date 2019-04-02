<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Auth;
use Illuminate\Http\Request;

class RegisterController extends Auth\RegisterController
{
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function register(Request $request)
    {
        if (($validator = $this->validator($request->all()))->fails()) {
            return [
                'successful' => true,
                'erreur' => $validator->errors()->first(),
            ];
        }

        event(new Registered($user = $this->create($request->all())));

        return [
            'successful' => true,
            'erreur' => null,
        ];
    }
}
