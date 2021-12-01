<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionsController extends Controller
{
    public function store(Request $request,Role $role)
    {
        return $role->givePermissionTo($request->permission_id);
    }
    public function destroy(Request $request,Role $role){
        return $role->revokePermissionTo($request->permission_id);
    }
}
