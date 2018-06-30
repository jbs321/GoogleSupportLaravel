<?php

namespace Google\Managers;

use Exception;

/**
 * Class GooglePlacesManager
 * @Documentation Google Places Auto-complete API - https://developers.google.com/places/web-service/autocomplete#location_restrict
 *
 * @Note Note From Google: You can use Place Autocomplete even without a map. If you do show a map, it must be a Google map.
 * When you display predictions from the Place Autocomplete service without a map, you  must include the 'Powered by Google' logo.
 *
 * No Support for XML currently
 */
class GooglePlacesAutoCompleteManager extends GoogleBaseManager
{
    protected $apiPath = "https://maps.googleapis.com/maps/api/place/autocomplete";

    /**
     * @param string $query
     *
     * @return GooglePlacesResponse
     */
    public function findAddressByQuery(string $query)
    {
        $fullQuery = $this->makeApiQuery($query);

        try {
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
        $components = ['ca'];
        $query = join("/", [$this->apiPath, $returnType]) . "?key={$this->apiKey}&input={$query}";

        if(count($components) > 5) {
            throw new Exception("Currently, you can use components to filter by up to 5 countries. " . count($components) . " given");
        }

        if (!empty($components)) {
            $components = array_map(function(string $countryCode) {
                return "country:{$countryCode}";
            }, $components);
            $restrictions = implode("|", $components);
            return  "$query&$restrictions";
        }
    }
}