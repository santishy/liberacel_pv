<?php

namespace App\Policies;

use App\Facades\InventoryContext;
use App\Http\Traits\HasAdministrator;
use App\Models\RaffleNumber;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RaffleNumberPolicy
{
    use HandlesAuthorization, HasAdministrator;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view raffle numbers');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RaffleNumber $raffleNumber): bool
    {
        return $user->hasPermissionTo('view raffle number') && (int) $raffleNumber->raffle->inventory_id === (int) InventoryContext::id();
    }

    /**
     * Determine whether the user can create models.
     */
    public function assign(User $user): bool
    {
        return $user->hasPermissionTo('assign raffle number');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RaffleNumber $raffleNumber): bool
    {
        return $user->hasPermissionTo('update raffle number') && (int) $raffleNumber->raffle->inventory_id === (int) InventoryContext::id();
    }

    public function release(User $user, RaffleNumber $raffleNumber): bool
    {
        return $user->hasPermissionTo('release raffle number') && (int) $raffleNumber->raffle->inventory_id === (int) InventoryContext::id();
    }
}
