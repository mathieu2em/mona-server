<?php

namespace App\Http\Controllers\V2\Auth;

use App\Http\Controllers\Auth;
use Illuminate\Http\Request;

class RegisterController extends Auth\RegisterController
{
    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        return ApiTokenController::update($request);
    }
}
