<?php

namespace Google\Managers;

use GuzzleHttp\Client;

/**
 * Class GooglePlacesManager
 * @Documentation Google Places API - https://developers.google.com/places/web-service/search
 */
class Google {

	const KEY_MAPPING = [
		GoogleMapsManager::class => 'google_maps',
		GoogleStaticMapsManager::class => 'google_static_maps',
		GoogleStreetViewManager::class => 'street_view',
		GooglePlacesManager::class => 'google_places',
	];

	public function maps() {
		return $this->getClassManager(GoogleMapsManager::class);
	}

	public function staticMaps() {
		return $this->getClassManager(GoogleStaticMapsManager::class);
	}

	public function streetView() {
		return $this->getClassManager(GoogleStreetViewManager::class);
	}

	public function places() {
		return $this->getClassManager(GooglePlacesManager::class);
	}

	public function getClassManager( $className ) {
		/** @var GoogleBaseManager $manager */
		$manager = new $className();
		$apiKey  = $this->findKeyMapping($className);
		$manager->setApiKey($apiKey)->setClient(new Client());
		return $manager;
	}
	
	public function findKeyMapping(string $className) {
		$confKey = self::KEY_MAPPING[$className];

		if(!$confKey) {
			throw new \Exception('Mapping doesn\'t exists');
		}

		//Taken from laravel global helper function config()
		$apiKey  = config(join('.', ["google" , "keys", $confKey]) );

		if(!$apiKey) {
			throw new \Exception('Missing API key for class: ' . self::class );
		}

		return $apiKey;
	}
}