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
    use PasswordValidationRules, AuthorizesRequests;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $this->authorize('create', new User);
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
            'username' => [Rule::unique(User::class), 'required'],
            'roles.*' => 'exists:roles,id'

        ], [
            'inventory_id.required' => 'El campo inventario es obligatorio si el usuario es administrador',
            'name' => 'El campo nombre es obligatorio',
            'email' => 'El campo email es obligatorio',
            'username' => 'El campo usuario es obligatorio',
            'roles.*.exists' => 'El rol seleccionado no existe',
            'password' => 'El campo contraseña es obligatorio y debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número'
        ])->validate();
        //no encripto password, ya que se hace en el modelo con setAttribute
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'username' => $input['username'],
            'password' => $input['password'], //Hash::make($input['password']),
            'inventory_id' => $input['inventory_id'],
        ]);
        return $user->assignRole(request()->roles);
    }

    function isAdmin()
    {
        foreach (request('roles', []) as $role) {
            if (Role::where('name', 'admin')->first()->id === $role)
                return [];
        }
        return ['required'];
    }
}
