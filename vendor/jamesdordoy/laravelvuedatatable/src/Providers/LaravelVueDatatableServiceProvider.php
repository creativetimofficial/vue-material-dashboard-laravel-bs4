<?php

namespace JamesDordoy\LaravelVueDatatable\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelVueDatatableServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/laravel-vue-datatables.php' => config_path('laravel-vue-datatables.php')
        ], 'config');
    }
}
