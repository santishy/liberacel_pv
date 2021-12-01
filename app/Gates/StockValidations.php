<?php
namespace App\Gates;
use App\Models\User;
use App\Models\Inventory;
use Illuminate\Support\Facades\Gate;

class StockValidations
{
    public function __construct(){
        Gate::define('view-stock',function(User $user,Inventory $inventory)
        {
            return $user->hasPermissionTo('view stock') || $user->hasRole('admin');
        });

        Gate::define('edit-stock',function(User $user,Inventory $inventory)
        {
            return $user->hasPermissionTo('edit stock') || $user->hasRole('admin');
        });

        Gate::define('empty-stock',function(User $user,Inventory $inventory)
        {
            return $user->hasPermissionTo('empty stock') || $user->hasRole('admin');
        });
    }
}