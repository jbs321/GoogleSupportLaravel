<?php

namespace Google\Managers;

use Google\Interfaces\GoogleApiInterface;
use Google\Traits\ApiKeyTrait;
use Google\Traits\ApiPathTrait;
use Google\Traits\GuzzleHttpClientTrait;


class GoogleBaseManager implements GoogleApiInterface {

	use GuzzleHttpClientTrait,
		ApiKeyTrait,
		ApiPathTrait;

	protected $params = [];
	protected $requiredParams = [];

	public function getImage( $path ) {
		$image = file_get_contents( $path );

		if ( ! $image ) {
			return response()->file( public_path() . "/img/not_found.jpg" );
		}

		$fp = fopen( 'image.png', 'w+' );

		fputs( $fp, $image );
		fclose( $fp );

		return $image;
	}

	public function createQuery( array $parameters = [] ) {
		$apiPath = $this->getApiPath();

		if(!$parameters) {
			return $apiPath;
		}

		$this->validateQuery($parameters);

		$queryParams = http_build_query($parameters);

		return join("?", [$apiPath, $queryParams]);
	}

	/**
	 * Validate all required parameters are set and all others belong to query
	 * else throw Exception
	 * @param array $parameters
	 *
	 * @throws \Exception
	 */
	public function validateQuery( array $parameters = [] ) {
		foreach ( $this->requiredParams as $parameter ) {
			if ( ! array_key_exists( $parameter, $parameters ) ) {
				throw new \Exception("Parameter {$parameter} is missing");
			}
		}

		foreach ($parameters as $key => $parameter) {
			if(!in_array($key, $this->params)) {
				throw new \Exception("Wrong Parameter Supplied: {$key}");
			}
		}
	}
}
