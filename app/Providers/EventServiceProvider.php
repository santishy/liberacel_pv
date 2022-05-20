<?php

namespace App\Providers;

use App\Events\FastSaleUpdated;
use App\Events\TransactionComplete;
use App\Listeners\UpdateInventory;
use App\Listeners\ChangeStatus;
use App\Listeners\CreateOrUpdateCommission;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TransactionComplete::class => [
            UpdateInventory::class,
        ],
        FastSaleUpdated::class => [      
            ChangeStatus::class,
            
            CreateOrUpdateCommission::class,
        ],
        
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
