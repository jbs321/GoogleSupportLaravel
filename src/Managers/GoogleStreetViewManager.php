<?php

namespace Google\Managers;

use Exception;
use Google\Traits\GuzzleHttpClientTrait;
use Google\Types\GooglePlacesResponse;

/**
 * Class GoogleStreetViewManager
 * @Documentation Google Places API - https://developers.google.com/maps/documentation/streetview/
 *
 * Required parameters, Either:
 * location can be either a text string (such as Chagrin Falls, OH) or a lat/lng value (40.457375,-80.009353).
 * The Google Street View Image API will snap to the panorama photographed closest to this location.
 * When an address text string is provided, the API may use a different camera location to better display the specified location.
 * When a lat/lng is provided, the API searches a 50 meter radius for a photograph closest to this location.
 * Because Street View imagery is periodically refreshed, and photographs may be taken from slightly different positions each time,
 * it's possible that your location may snap to a different panorama when imagery is updated.
 * Or:
 * pano is a specific panorama ID. These are generally stable.
 */
class GoogleStreetViewManager extends GoogleBaseManager {

	/**
	 * Base URI for google textsearch - https://maps.googleapis.com/maps/api/streetview?parameters
	 */
	protected $apiPath = "https://maps.googleapis.com/maps/api/streetview";

	/**
	 * Free Usage: 640 x 640 maximum image resolution.
	 * Premium Usage: 2048 x 2048 maximum image resolution.
	 **/
	public function findImageByAddress( $address = "", $width = 640, $height = 640) {
		$address  = urlencode( $address );

		$path  = "{$this->apiPath}?size={$width}x{$height}&location={$address}&key={$this->apiKey}";

		$image = file_get_contents( $path );

		if ( ! $image ) {
			return response()->file( public_path() . "/img/not_found.jpg" );
		}

		$fp = fopen( 'image.png', 'w+' );

		fputs( $fp, $image );
		fclose( $fp );

		return $image;
	}
}