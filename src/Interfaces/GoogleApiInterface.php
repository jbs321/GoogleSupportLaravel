<?php

namespace Google\Interfaces;


interface GoogleApiInterface {
	public function getApiKey();
	public function getApiPath();
	public function setApiKey(string $apiKey);
	public function setApiPath(string $apiPath);
}