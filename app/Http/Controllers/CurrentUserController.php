<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class CurrentUserController extends Controller
{
    public function __invoke()
    {
        return new UserResource(Auth::user());
    }
}
