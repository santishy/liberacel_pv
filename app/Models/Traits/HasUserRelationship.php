<?php

namespace App\Models\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

trait HasUserRelationship
{

    public function checkCredentials($username, $password)
    {
        $user = User::where('username', $username)
            ->where('active', true)->first();

        if (!$user && !Hash::check($password, optional($user)->password)) {
            throw ValidationException::withMessages([
                'check' => 'Usuario ó contraseña incorrectos.'
            ]);
        }
        return $user;
    }

    public function toggleUser($user)
    {
        if ($this->user()->exists()) {
            $this->user()->dissociate();
            //$model->save();
        }
        $this->user()->associate($user);
        $this->save();
    }
}
