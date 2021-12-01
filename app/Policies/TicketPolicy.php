<?php

namespace App\Policies;

use App\Http\Traits\HasAdministrator;
use App\Models\User;
use App\Models\ticket;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ticket  $ticket
     * @return mixed
     */
    public function view(User $user, ticket $ticket)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ticket  $ticket
     * @return mixed
     */
    public function update(User $user, ticket $ticket)
    {
        return $user->hasPermissionTo('edit ticket');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ticket  $ticket
     * @return mixed
     */
    public function delete(User $user, ticket $ticket)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ticket  $ticket
     * @return mixed
     */
    public function restore(User $user, ticket $ticket)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ticket  $ticket
     * @return mixed
     */
    public function forceDelete(User $user, ticket $ticket)
    {
        //
    }
}
