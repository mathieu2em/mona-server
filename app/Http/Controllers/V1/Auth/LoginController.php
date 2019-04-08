<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Auth;
use Illuminate\Http\Request;

class LoginController extends Auth\LoginController
{
    /**
     * Handle a login request to the application.
     *
     * @param  Request  $request
     * @return array
     */
    public function login(Request $request)
    {
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  Request  $request
     * @return array
     */
    protected function sendLoginResponse(Request $request)
    {
        return [
            'successful' => true,
            'erreur' => null,
        ];
    }

    /**
     * Get the failed login response instance.
     *
     * @param  Request  $request
     * @return array
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return [
            'successful' => false,
            'erreur' => trans('auth.failed'),
        ];
    }
}
