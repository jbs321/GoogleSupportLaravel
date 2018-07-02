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

    const SERVICE__GOOGLE_MAPS = "google_maps";
    const SERVICE__GOOGLE_STATIC_MAPS = "google_static_maps";
    const SERVICE__GOOGLE_STREET_VIEW = "street_view";
    const SERVICE__GOOGLE_PLACES = "google_places";

    const KEY_MAPPING = [
        GoogleMapsManager::class => self::SERVICE__GOOGLE_MAPS,
        GoogleStaticMapsManager::class => self::SERVICE__GOOGLE_STATIC_MAPS,
        GoogleStreetViewManager::class => self::SERVICE__GOOGLE_STREET_VIEW,
        GooglePlacesManager::class => self::SERVICE__GOOGLE_PLACES,
        GooglePlacesAutoCompleteManager::class => self::SERVICE__GOOGLE_PLACES,
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

    public function placesAutoComplete(): GooglePlacesAutoCompleteManager
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
        if (!class_exists($className)) {
            throw new \Exception("Class $className dosn't exist");
        }

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