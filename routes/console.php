<?php

use App\User;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('job:dispatch {job}', function ($job) {
    app("App\\Jobs\\$job")::dispatchNow();
})->describe('Dispatch a job immediately');

Artisan::command('user:role {user} {role=user}', function ($user, $role) {
    User::where('username', $user)->update(['role' => $role]);
})->describe('Set the user\'s role');
