<?php

namespace App\Authorization;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;


class CurrentUser
{
    public function show()
    {
        return new UserResource(Auth::user());
    }
}