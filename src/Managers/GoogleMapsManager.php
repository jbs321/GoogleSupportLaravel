<?php

namespace Google\Managers;

use Exception;
use Google\Traits\GuzzleHttpClientTrait;
use Google\Types\GooglePlacesResponse;

/**
 * Class GoogleMapsManager
 * @Documentation Google Maps API - https://developers.google.com/maps/documentation
 */
class GoogleMapsManager extends GoogleBaseManager
{
	/**
	 * Base URI for google textsearch
	 */
	protected $apiPath = "https://maps.googleapis.com/maps/api";
}