<?php

namespace App\Policies;

use App\Http\Traits\HasAdministrator;
use App\Models\User;
use App\Models\sale;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalePolicy
{
    use HandlesAuthorization,HasAdministrator;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('view sales');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\sale  $sale
     * @return mixed
     */
    public function view(User $user, sale $sale)
    {
        return $user->hasPermissionTo('view sale');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create sale');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\sale  $sale
     * @return mixed
     */
    public function update(User $user, sale $sale)
    {
        return $user->haspermissionTo('edit sale');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\sale  $sale
     * @return mixed
     */
    public function delete(User $user, sale $sale)
    {
        return $user->haspermissionTo('delete sale');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\sale  $sale
     * @return mixed
     */
    public function restore(User $user, sale $sale)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\sale  $sale
     * @return mixed
     */
    public function forceDelete(User $user, sale $sale)
    {
        //
    }
}
