<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\Category\CategoryRepo::class, \App\Repositories\Category\CategoryRepoEloquent::class);
        $this->app->bind(\App\Repositories\Item\ItemRepo::class, \App\Repositories\Item\ItemRepoEloquent::class);
        $this->app->bind(\App\Repositories\Customer\CustomerRepo::class, \App\Repositories\Customer\CustomerRepoEloquent::class);
        $this->app->bind(\App\Repositories\Supplier\SupplierRepo::class, \App\Repositories\Supplier\SupplierRepoEloquent::class);
        $this->app->bind(\App\Repositories\Order\OrderRepo::class, \App\Repositories\Order\OrderRepoEloquent::class);
        $this->app->bind(\App\Repositories\OrderDetail\OrderDetailRepo::class, \App\Repositories\OrderDetail\OrderDetailRepoEloquent::class);
        $this->app->bind(\App\Repositories\PurchaseReceipt\PurchaseReceiptRepo::class, \App\Repositories\PurchaseReceipt\PurchaseReceiptRepoEloquent::class);
        $this->app->bind(\App\Repositories\PurchaseReceiptDetail\PurchaseReceiptDetailRepo::class, \App\Repositories\PurchaseReceiptDetail\PurchaseReceiptDetailRepoEloquent::class);
        //:end-bindings:
    }
}
