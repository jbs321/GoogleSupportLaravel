<?php

namespace Google\Traits;


trait ApiKeyTrait {
	/**
	 * @var string - key to access api, it's generated from google side
	 */
	protected $apiKey;


	/**
	 * @return mixed
	 * @throws \Exception
	 */
	public function getApiKey() {
		if(!$this->apiKey) {
			throw new \Exception('Missing API key for class: ' . self::class );
		}

		return $this->apiKey;
	}

	/**
	 * @param string $apiKey
	 *
	 * @return $this
	 */
	public function setApiKey( string $apiKey) {
		$this->apiKey = $apiKey;

		return $this;
	}

}