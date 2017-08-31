<?php

namespace Google\Facades;

use Google\Managers\GoogleMapsManager;
use Google\Managers\GooglePlacesManager;
use Google\Managers\GoogleStaticMapsManager;
use Google\Managers\GoogleStreetViewManager;
use Illuminate\Support\Facades\Facade;
use Google\Managers\Google as GoogleManager;

/**
 * @method static GoogleMapsManager maps()
 * @method static GoogleStaticMapsManager staticMaps()
 * @method static GoogleStreetViewManager streetView()
 * @method static GooglePlacesManager places()
 *
 * @see GoogleMapsManager
 * @see GoogleStaticMapsManager
 * @see GoogleStreetViewManager
 * @see GooglePlacesManager
 */
class Google extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return GoogleManager::class;
    }
}
