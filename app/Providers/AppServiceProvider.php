<?php

namespace App\Providers;

use App\Models\CashFlow;
use App\Models\Order;
use App\Models\PurchaseReceipt;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
           CashFlow::TYPE_ORDER => Order::class,
           CashFlow::TYPE_PURCHASE => PurchaseReceipt::class
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
