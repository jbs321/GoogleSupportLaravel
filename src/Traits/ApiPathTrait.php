<?php

namespace Google\Traits;

trait ApiPathTrait {
	/**
	 * @var string - path to api
	 */
	protected $apiPath;

	/**
	 * @return mixed
	 */
	public function getApiPath() {
		return $this->apiPath;
	}

	/**
	 * @param string $apiPath
	 *
	 * @return $this
	 */
	public function setApiPath( string $apiPath ) {
		$this->apiPath = $apiPath;

		return $this;
	}
}