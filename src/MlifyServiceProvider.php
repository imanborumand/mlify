<?php

namespace Imanborumand\Mlify;

use Illuminate\Support\ServiceProvider;

class MlifyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
                             __DIR__.'/../config/mlify.php' => config_path('mlify.php')
                         ], 'mlify-config');
    }
}
