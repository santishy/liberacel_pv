<?php

namespace App\Models\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

trait HasUserRelationship{
    
    public function checkCredentials($username,$password){
        $user = User::where('username', $username)->first();

        if (!Hash::check($password, optional($user)->password)) {
            return response()
                ->json(
                    ['errors' => ['error' => 'Nombre de usuario ó contraseña, incorrectos.']],
                    422
                );
        }
        return $user;
    }
    
    public function toggleUser($user){
        if ($this->user()->exists()) {
            $this->user()->dissociate();
            //$model->save();
        }
        $this->user()->associate($user);
        $this->save();
    }
}
