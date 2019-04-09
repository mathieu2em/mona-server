<?php

namespace App\Http\Controllers\V2\Auth;

use App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoginController extends Auth\LoginController
{
    /**
     * Log the user out of the application.
     *
     * @param  Request  $request
     * @return Response
     */
    public function logout(Request $request)
    {
        return $this->loggedOut($request);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  Request  $request
     * @return Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user());
    }

    /**
     * The user has been authenticated.
     *
     * @param  Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        return (new ApiTokenController)->update($request);
    }

    /**
     * The user has logged out of the application.
     *
     * @param  Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        return (new ApiTokenController)->invalidate($request);
    }
}
