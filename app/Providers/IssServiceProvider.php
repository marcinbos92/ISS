<?php

namespace App\Providers;

use App\Services\IssLocator\IssLocator;
use App\Services\IssLocator\IssLocatorInterface;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

class IssServiceProvider extends ServiceProvider
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
        $this->app->singleton(IssLocatorInterface::class, function (Container $container) {
            $locator = new IssLocator($container->get(ClientInterface::class));
            //for this time I removed it from env/config
            $locator->setPath('https://api.wheretheiss.at/v1/satellites');

            return $locator;
        });
        $this->app->singleton(ClientInterface::class, Client::class);
    }
}
