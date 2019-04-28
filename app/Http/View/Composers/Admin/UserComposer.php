<?php

namespace App\Http\View\Composers\Admin;

use App\User;
use App\Http\Resources\User as UserResource;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

class UserComposer
{
    /**
     * TODO.
     *
     * @var TODO
     */
    protected $users;

    /**
     * Create a new user composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->users = UserResource::collection(
            Cache::remember('admin.users', now()->addHours(1), function () {
                return User::all();
            }));
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('users', $this->users->toJson());
    }
}
