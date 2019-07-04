<?php

namespace DivineOmega\LaravelGeolocationRequest\Traits;

use DivineOmega\Countries\Country;
use DivineOmega\DOFileCachePSR6\CacheItemPool;
use DivineOmega\Geolocation\Interfaces\LocationProviderInterface;
use DivineOmega\Geolocation\Locator;

trait GeolocatableRequest
{
    private $locationProvider;

    /**
     * Set an alternative location provider for geolocation.
     *
     * @param LocationProviderInterface $locationProvider
     */
    public function setLocationProvider(LocationProviderInterface $locationProvider)
    {
        $this->locationProvider = $locationProvider;
    }

    /**
     * Retrieve the origin country of the request, based on its IP address.
     *
     * @return Country
     */
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