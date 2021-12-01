<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionResource;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny',new Role);
        if (request()->wantsJson())
            return response()->json([
                'data' => Role::all()->pluck('name','id'),

            ]);
    }
    public function create()
    {
        $this->authorize('create',new Role);
        // $permissions = Permission::all('name', 'id');
        $permissions = PermissionResource::collection( Permission::orderBy('name','asc')->get());
        $roles = Role::where('name','!=', 'admin')->get();
        return view('auth.roles.create', compact('permissions', 'roles'));
    }

    public function store(Request $request)
    {
        $this->authorize('create',new Role);
        $request->validate([
            'name' => ['required']
        ]);

        try {
            $role = Role::create(['name' => $request->name]);
            return $role->only('id', 'name');
        } catch (RoleAlreadyExists $e) {
            throw ValidationException::withMessages([
                'name' => ['El rol ya existe en la base de datos.']
            ]);
            return false;
        }
    }

    public function show(Role $role)
    {
        $this->authorize('view',$role);
        return response()->json(['data' => $role->include()->where('id',$role->id)->first()]);
    }
}
