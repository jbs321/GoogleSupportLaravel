<?php

namespace Google\Managers;

use Exception;
use Google\Traits\GuzzleHttpClientTrait;
use Google\Types\GooglePlacesResponse;

/**
 * Class GoogleMapsManager
 * @Documentation Google Maps API - https://developers.google.com/maps/documentation/static-maps
 */
class GoogleStaticMapsManager extends GoogleBaseManager
{
	//Location Parameters:
	const PARAM_CENTER = "center";

	/**
	 * Zoom Levels
	 * 1: World
	 * 5: Landmass/continent
	 * 10: City
	 * 15: Streets
	 * 20: Buildings
	 */
	const PARAM_ZOOM = "zoom";

	//Map Parameters:
	const PARAM_SIZE = "size";
	const PARAM_SCALE = "scale";
	const PARAM_FORMAT = "format";
	const PARAM_MAPTYPE = "maptype";
	const PARAM_LANGUAGE = "language";
	const PARAM_REGION = "region";

	//Feature Parameters
	const PARAM_MARKERS = 'markers';
	const PARAM_PATH    = 'path';
	const PARAM_VISIBLE = 'visible';
	const PARAM_STYLE   = 'style';

	//Key and Signature Parameters
	const PARAM_KEY = "key";
	const PARAM_SIGNATURE = "signature";

	protected $params = [
		self::PARAM_CENTER,
		self::PARAM_ZOOM,
		self::PARAM_SIZE,
		self::PARAM_SCALE,
		self::PARAM_FORMAT,
		self::PARAM_MAPTYPE,
		self::PARAM_LANGUAGE,
		self::PARAM_REGION,
		self::PARAM_MARKERS,
		self::PARAM_PATH,
		self::PARAM_VISIBLE,
		self::PARAM_STYLE,
		self::PARAM_KEY,
		self::PARAM_SIGNATURE,
	];

	protected $requiredParams = [
		self::PARAM_CENTER,
		self::PARAM_ZOOM,
		self::PARAM_SIZE,
		self::PARAM_KEY,
	];

	/**
	 * Base URI for google textsearch
	 */
	protected $apiPath = "https://maps.googleapis.com/maps/api/staticmap";

	/**
	 * Free Usage: 640 x 640 maximum image resolution.
	 * Premium Usage: 2048 x 2048 maximum image resolution.
	 **/
	public function findImageByAddress( $address = "", $width = 640, $height = 640, $zoom = 15) {
		$address  = urlencode( $address );

		$path     = $this->createQuery([
			self::PARAM_CENTER => $address,
			self::PARAM_SIZE   => "{$width}x{$height}",
			self::PARAM_ZOOM   => $zoom,
			self::PARAM_KEY    => $this->apiKey,
		]);

		$image = $this->getImage($path);
		return $image;
	}
}