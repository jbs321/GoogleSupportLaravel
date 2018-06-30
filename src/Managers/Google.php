<?php

namespace Google\Managers;

use GuzzleHttp\Client;

/**
 * Class GooglePlacesManager
 * @Documentation Google Places API - https://developers.google.com/places/web-service/search
 */
class Google
{

    const CONFIG_KEY_KEYS = 'keys';
    const CONFIG_KEY_GOOGLE = 'google';

    const KEY_MAPPING = [
        GoogleMapsManager::class => 'google_maps',
        GoogleStaticMapsManager::class => 'google_static_maps',
        GoogleStreetViewManager::class => 'street_view',
        GooglePlacesManager::class => 'google_places',
        GooglePlacesAutoCompleteManager::class => 'google_places',
    ];

    public function maps(): GoogleMapsManager
    {
        return $this->getClassManager(GoogleMapsManager::class);
    }

    public function staticMaps(): GoogleStaticMapsManager
    {
        return $this->getClassManager(GoogleStaticMapsManager::class);
    }

    public function streetView(): GoogleStreetViewManager
    {
        return $this->getClassManager(GoogleStreetViewManager::class);
    }

    public function places(): GooglePlacesManager
    {
        return $this->getClassManager(GooglePlacesManager::class);
    }

    public function autoComplete(): GooglePlacesAutoCompleteManager
    {
        return $this->getClassManager(GooglePlacesAutoCompleteManager::class);
    }

    /**
     * Get class ref and return new instance of class
     * @param string $className
     *
     * @return GoogleBaseManager
     */
    public function getClassManager(string $className): GoogleBaseManager
    {
        /** @var GoogleBaseManager $manager */
        $manager = new $className();
        $apiKey = $this->findConfigKey($className);
        $manager->setApiKey($apiKey)->setClient(new Client());
        return $manager;
    }

    public function findConfigKey(string $className)
    {
        $confKey = self::KEY_MAPPING[$className];

        if (!$confKey) {
            throw new \Exception('Mapping doesn\'t exists');
        }

        //Taken from laravel global helper function config()
        $apiKey = join('.', [self::CONFIG_KEY_GOOGLE, self::CONFIG_KEY_KEYS, $confKey]);
        $keyConfigValue = config($apiKey);

        if (!$keyConfigValue) {
            throw new \Exception('Missing API key for class: ' . self::class);
        }

        return $keyConfigValue;
    }
}