<?php

namespace Google\Traits;

use GuzzleHttp\Client as Client;

/**
 * Trait GuzzleHttpClientTrait
 * @package app\Traits
 */
trait GuzzleHttpClientTrait {
	protected $client;

	/**
	 * @return Client
	 */
	public function getClient() : Client {

		if(!$this->client instanceof Client ) {
			return new Client();
		}

		return $this->client;
	}

	/**
	 * @param Client $client
	 *
	 * @return $this
	 */
	public function setClient( Client $client ) {
		$this->client = $client;

		return $this;
	}
}