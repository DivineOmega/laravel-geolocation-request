<?php

namespace DivineOmega\LaravelGeolocationRequest\Traits;

use DivineOmega\DOFileCachePSR6\CacheItemPool;
use DivineOmega\Geolocation\Interfaces\LocationProviderInterface;
use DivineOmega\Geolocation\Locator;

trait GeolocatableRequest
{
    private $locationProvider;

    public function setLocationProvider(LocationProviderInterface $locationProvider)
    {
        $this->locationProvider = $locationProvider;
    }

    public function country()
    {
        $locator = new Locator();

        if ($this->locationProvider) {
            $locator->setLocationProvider($this->locationProvider);
        }

        $cacheItemPool = new CacheItemPool();
        $cacheItemPool->changeConfig([
            'cacheDirectory' => __DIR__.'/../../cache/',
        ]);

        $locator->setCache($cacheItemPool);

        $ip = $this->getClientIp();

        return $locator->getCountryByIP($ip);
    }
}