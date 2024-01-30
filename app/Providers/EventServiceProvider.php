<?php

namespace App\Providers;

use App\Events\ApplyElectronicMoneyDiscount;
use App\Events\FastSaleUpdated;
use App\Events\SaleTransactionProcessed;
use App\Events\TransactionComplete;
use App\Listeners\AddPointsToCustomerBonus;
use App\Listeners\UpdateInventory;
use App\Listeners\ChangeStatus;
use App\Listeners\CreateOrUpdateCommission;
use App\Listeners\DecreaseCustomerBonusDiscountPoints;
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
        SaleTransactionProcessed::class => [
            CreateOrUpdateCommission::class,
        ],
        FastSaleUpdated::class => [
            ChangeStatus::class,
            AddPointsToCustomerBonus::class,
            // CreateOrUpdateCommission::class,
        ],
        ApplyElectronicMoneyDiscount::class => [
            DecreaseCustomerBonusDiscountPoints::class,
        ]
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
