<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Auth\RegisterController
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        /* XXX */
        return Validator::make($data, [
            'username' => ['required', 'string', 'alpha_dash', 'max:255', 'unique:users'],
            'email' => ['sometimes', 'required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  Request  $request
     * @return array
     */
    public function register(Request $request)
    {
        if (($validator = $this->validator($request->all()))->fails()) {
            return [
                'successful' => false,
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
