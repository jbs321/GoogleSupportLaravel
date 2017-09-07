<?php

namespace Google\Managers;

use Exception;
use Google\Types\GooglePlacesResponse;

/**
 * Class GooglePlacesManager
 * @Documentation Google Places API - https://developers.google.com/places/web-service/search
 */
class GooglePlacesManager extends GoogleBaseManager
{
	protected $apiPath = "https://maps.googleapis.com/maps/api/place/textsearch";

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
		$query = join("/", [$this->apiPath, $returnType]) . "?key={$this->apiKey}&query={$query}";
		return $query;
	}
}