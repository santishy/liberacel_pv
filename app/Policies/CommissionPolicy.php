<?php

namespace App\Policies;

use App\Http\Traits\HasAdministrator;
use App\Models\Commission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommissionPolicy
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
        return $user->hasPermissionTo('view user commissions');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Commission $commission)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Commission $commission)
    {
        return $user->hasPermissionTo('edit user commission');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Commission $commission)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Commission $commission)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Commission $commission)
    {
        //
    }
}
