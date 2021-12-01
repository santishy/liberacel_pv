<?php

namespace App\Http\Traits;

use App\Models\User;

trait HasAdministrator
{

    public function before(User $user)
    {
        if($user->hasRole('admin')){
            return true;
        }
    }
}
