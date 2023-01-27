<?php

namespace Grayloon\Magento;

use Illuminate\Support\ServiceProvider;

class MagentoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->registerPublishing();
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    private function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/magento.php' => config_path('magento.php'),
            ], 'magento-config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/magento.php', 'magento');

        // Register the main class to use with the facade
        $this->app->singleton('magento', function () {
            return new Magento();
        });
    }
}
