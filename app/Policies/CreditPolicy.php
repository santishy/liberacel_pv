<?php

namespace App\Policies;

use App\Http\Traits\HasAdministrator;
use App\Models\Credit;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CreditPolicy
{
    use HandlesAuthorization;
    use HasAdministrator;
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('view credits');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Credit  $credit
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Credit $credit)
    {
        return $user->hasPermissionTo('view credit');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo("create credit");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Credit  $credit
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Credit $credit)
    {
        return $user->hasPermissionTo('edit credit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Credit  $credit
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Credit $credit)
    {
        $user->hasPermissionTo('delete credit');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Credit  $credit
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Credit $credit)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Credit  $credit
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Credit $credit)
    {
        //
    }
}
