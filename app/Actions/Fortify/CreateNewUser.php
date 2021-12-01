<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Spatie\Permission\Models\Role;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules,AuthorizesRequests;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $this->authorize('create',new User);
        $isAdmin = $this->isAdmin();
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'inventory_id' => $isAdmin,
            'password' => $this->passwordRules(),
            'roles.*' => 'exists:roles,id'
        ])->validate();
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'inventory_id' => $input['inventory_id']  ,
        ]);
        return $user->assignRole(request()->roles);


    }

    function isAdmin(){
        foreach(request('roles',[]) as $role){
            if(Role::where('name','admin')->first()->id === $role)
                return [];
        }
        return ['required'];
    }

}
