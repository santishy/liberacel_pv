<?php

namespace App\Policies;

use App\Models\Raffle;
use App\Http\Traits\HasAdministrator;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Facades\InventoryContext;

class RafflePolicy
{
        use HandlesAuthorization, HasAdministrator;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view raffles');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Raffle $raffle): bool
    {
        return $user->hasPermissionTo('view raffle') && (int) $raffle->inventory_id === (int) InventoryContext::id();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create raffle') ;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Raffle $raffle): bool
    {
        return $user->hasPermissionTo('edit raffle') && (int) $raffle->inventory_id === (int) InventoryContext::id();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Raffle $raffle): bool
    {
        return $user->hasPermissionTo('delete raffle') && (int) $raffle->inventory_id === (int) InventoryContext::id(); 
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Raffle $raffle): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Raffle $raffle): bool
    {
        //
    }
}
