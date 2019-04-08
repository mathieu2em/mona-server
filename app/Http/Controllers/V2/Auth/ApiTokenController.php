<?php

namespace App\Http\Controllers\V2\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ApiTokenController extends Controller
{
    /**
     * Update the authenticated user's API token.
     *
     * @param  Request  $request
     * @return array
     */
    public function update(Request $request)
    {
        $token = Str::random(60);

        $request->user()->forceFill([
            'api_token' => hash('sha256', $token),
        ])->save();

        return ['token' => $token];
    }

    /**
     * Invalidate the authenticated user's API token.
     *
     * @param  Request  $request
     * @return array
     */
    public function invalidate(Request $request)
    {
        $request->user()->forceFill([
            'api_token' => null,
        ])->save();

        return [];
    }
}
