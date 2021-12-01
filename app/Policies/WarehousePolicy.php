<?php

namespace App\Policies;

use App\Http\Traits\HasAdministrator;
use App\Models\Inventory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class WarehousePolicy
{
    use HandlesAuthorization;
    use HasAdministrator;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('view warehouses');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Inventory  $inventory
     * @return mixed
     */
    public function view(User $user, Inventory $inventory)
    {
        return $user->hasPermissionTo('view warehouse');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create warehouse');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Inventory  $inventory
     * @return mixed
     */
    public function update(User $user, Inventory $inventory)
    {
        return $user->hasPermissionTo('edit warehouse');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Inventory  $inventory
     * @return mixed
     */
    public function delete(User $user, Inventory $inventory)
    {
        return $user->haspermissionTo('delete warehouse');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Inventory  $inventory
     * @return mixed
     */
    public function restore(User $user, Inventory $inventory)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Inventory  $inventory
     * @return mixed
     */
    public function forceDelete(User $user, Inventory $inventory)
    {
        //
    }
}
