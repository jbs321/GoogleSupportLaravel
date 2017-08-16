<?php

namespace Google\Providers;

use Exception;
use Google\Managers\GoogleManager;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class GoogleServiceProvider extends ServiceProvider {
	protected $defer = false;

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton(GoogleManager::class, function ($app) {
			if (!config("app.app_google_places_api_key")) {
				throw new Exception("Google Places App key is missing");
			}

			$appKey = config("app.app_google_places_api_key");
			$service = new GoogleManager($appKey);
			$service->setClient(new Client());

			return $service;
		});
	}
}