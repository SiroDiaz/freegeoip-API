<?php

namespace Siro\Freegeoip;

use Siro\Freegeoip\Freegeoip;
use Illuminate\Support\ServiceProvider;

class FreegeoipApiServiceProvider
{
    protected $defer = true;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/freegeoip.php' => config_path('freegeoip.php'),
        ]);
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Siro\Freegeoip\Freegeoip', function ($app) {
            return new Freegeoip($app['config']->get('freegeoip'));
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Siro\Freegeoip\Freegeoip'];
    }
}