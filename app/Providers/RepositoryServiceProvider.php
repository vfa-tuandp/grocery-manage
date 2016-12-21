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
        //:end-bindings:
    }
}
