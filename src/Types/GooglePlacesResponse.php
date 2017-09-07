<?php

namespace Google\Types;

use App\Exceptions\NotFoundException;
use Google\Facades\Google;
use Illuminate\Database\Eloquent\Collection;
use Psr\Http\Message\StreamInterface;

class GooglePlacesResponse {
	const KEY__STATUS = "status";
	const KEY__RESULTS = "results";
	const KEY__HTML_ATTRIBUTIONS = "html_attributions";

	const KEY__RESPONSE_TYPE_XML = "xml";
	const KEY__RESPONSE_TYPE_JSON = "json";

	/**  indicates that no errors occurred; the place was successfully detected and at least one result was returned. */
	const STATUS_TYPE__OK = "OK";
	/**  indicates that the search was successful but returned no results. This may occur if the search was passed a latlng in a remote location. */
	const STATUS_TYPE__ZERO_RESULTS = "ZERO_RESULTS";
	/**  indicates that you are over your quota. */
	const STATUS_TYPE__OVER_QUERY_LIMIT = "OVER_QUERY_LIMIT";
	/**  indicates that your request was denied, generally because of lack of an invalid key parameter. */
	const STATUS_TYPE__REQUEST_DENIED = "REQUEST_DENIED";
	/**  generally indicates that a required query parameter (location or radius) is missing. */
	const STATUS_TYPE__INVALID_REQUEST = "INVALID_REQUEST";

	/** @var  string -  contains metadata on the request. See Status Codes below. */
	private $status;

	/** @var  Collection - contains an array of places, with information about each. See Search Results for information about these results. The Places API returns up to 20 establishment results per query. Additionally, political results may be returned which serve to identify the area of the request. */
	private $results;

	/** @var  array - contain a set of attributions about this listing which must be displayed to the user. */
	private $htmlAttributes;

	public function __construct( StreamInterface $googleResponse ) {
		$data = json_decode( $googleResponse, true );

		if ( ! array_key_exists( self::KEY__RESULTS, $data ) ) {
			throw new NotFoundException( "Google Places Response is missing key: " . self::KEY__RESULTS );
		}

		if ( ! array_key_exists( self::KEY__STATUS, $data ) ) {
			throw new NotFoundException( "Google Places Response is missing key: " . self::KEY__STATUS );
		}

		if ( ! array_key_exists( self::KEY__RESULTS, $data ) ) {
			throw new NotFoundException( "Google Places Response is missing key: " . self::KEY__HTML_ATTRIBUTIONS );
		}

		$this->init( $data );
	}

	public function init( $data ) {
		$this->setStatus( $data[ self::KEY__STATUS ] );
		$this->setResults( $data[ self::KEY__RESULTS ] );
		$this->setHtmlAttributes( $data[ self::KEY__HTML_ATTRIBUTIONS ] );
	}

	/**
	 * @return Collection
	 */
	public function getResults() {
		return $this->results;
	}

	/**
	 * @param Collection $results
	 */
	public function setResults( array $results ) {
		$resultCollection = new Collection();
		foreach ( $results as $resultElement ) {
			$resultCollection->add( new GooglePlacesResult( $resultElement ) );
		}

		$this->results = $resultCollection;
	}

	/**
	 * @return mixed
	 */
	public function getHtmlAttributes() {
		return $this->htmlAttributes;
	}

	/**
	 * @param mixed $htmlAttributes
	 */
	public function setHtmlAttributes( $htmlAttributes ) {
		$this->htmlAttributes = $htmlAttributes;
	}

	/**
	 * @return mixed
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @return mixed
	 */
	public function isFound() {
		return $this->status === self::STATUS_TYPE__OK;
	}

	/**
	 * @param mixed $status
	 */
	public function setStatus( $status ) {
		$this->status = $status;
	}

	public function toArray(  ) {
		return $this->results->map(function(GooglePlacesResult $googleResult) {
			return $googleResult->toArray();
		});
	}
}