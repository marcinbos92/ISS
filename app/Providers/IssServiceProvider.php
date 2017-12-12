<?php

namespace App\Providers;

use App\Services\GeoCoder\GeoCoder;
use App\Services\GeoCoder\GeoCoderInterface;
use App\Services\IssLocator\IssLocator;
use App\Services\IssLocator\IssLocatorInterface;
use App\Services\Transformers\AbstractTransformer;
use App\Services\Transformers\WebTransformer;
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
        $this->app->singleton(AbstractTransformer::class, WebTransformer::class);

        $this->app->singleton(GeoCoderInterface::class, function (Container $container) {
            //Moved to this place for omitting cache config issues.
            return new GeoCoder(
                $container->get(ClientInterface::class),
                'https://maps.googleapis.com/maps/api/geocode/json',
                //it must be in env, generated ONLY for recruitment task
                'AIzaSyBT6v_5Q5me-qxI27uN0nzZ-5aLIZd6jTk'
            );
        });
    }
}
