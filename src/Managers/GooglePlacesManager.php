<?php

namespace Google\Managers;

use Exception;
use Google\Traits\GuzzleHttpClientTrait;
use Google\Types\GooglePlacesResponse;

/**
 * Class GooglePlacesManager
 * @Documentation Google Places API - https://developers.google.com/places/web-service/search
 */
class GoogleManager
{
	use GuzzleHttpClientTrait;

	/**
	 * Base URI for google textsearch
	 */
	const BASE_URI = "https://maps.googleapis.com/maps/api/place/textsearch";

	/**
	 * @var string App Key for Google Places Api
	 */
	protected $appKey;


	/**
	 * GooglePlacesManager constructor.
	 *
	 * @param string $appKey
	 *
	 * @throws Exception
	 */
	public function __construct($appKey)
	{
		$this->appKey = $appKey;
	}

	/**
	 * @param string $query
	 *
	 * @return GooglePlacesResponse
	 */
	public function findAddressByQuery(string $query)
	{
		$fullQuery = $this->makeApiQuery($query);

		try{
			$googleResponse = $this->getClient()->get($fullQuery)->getBody();
		} catch (Exception $te) {
			abort(500, "Technical Issue please contact System Admin");
		}

		$data = new GooglePlacesResponse($googleResponse);
		return $data;
	}

	/**
	 * @param string $query
	 * @param string $returnType
	 *
	 * @return string
	 */
	public function makeApiQuery($query = "", $returnType = GooglePlacesResponse::KEY__RESPONSE_TYPE_JSON)
	{
		$query = join("/", [self::BASE_URI, $returnType]) . "?key={$this->appKey}&query={$query}";
		return $query;
	}
}