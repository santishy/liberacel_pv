<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Inventory;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index()
    {
        $this->authorize('viewAny', new User);

        if (request()->wantsJson()) {
            return User::with('roles:name,id')->orderBy('id', 'desc')->get();
        }
        return view('users.index');
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $roles  = Role::all('name', 'id');
        $inventories = Inventory::all();
        $user = $user->with('roles:id,name')->where('id', $user->id)->first();
        return view('users.edit', compact('user', 'roles', 'inventories'));
    }


    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $user->update($request->safe()->except('roles'));

        $user->syncRoles($request->roles);
        return $user->save();
    }

    public function delete(User $user)
    {
        $user->update(["active" => false]);
        return response()->json([
            "user" => $user
        ]);
    }
}
