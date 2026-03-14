<?php

namespace App\Policies;

use App\Http\Traits\HasAdministrator;
use App\Models\FastSale;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FastSalePolicy
{
    use HandlesAuthorization, HasAdministrator;

    /**
     * Determine whether the user can view any models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('view fast sales');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, FastSale $fastSale)
    {
        return $user->hasPermissionTo('view fast sale');
    }

    /**
     * Determine whether the user can create models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create fast sale');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, FastSale $fastSale)
    {

        return $user->hasPermissionTo('edit fast sale');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, FastSale $fastSale)
    {
        return $user->hasPermissionTo('delete fast sale product');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, FastSale $fastSale)
    {
        if (request()->has('status')) {
            if (request()->get('status') == 'cancelled') {
                return $user->hasPermissionTo('cancel fast sale');
            }
        }

        return $user->hasPermissionTo('create fast sale');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, FastSale $fastSale)
    {
        //
    }
}
