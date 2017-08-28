<?php

namespace Google\Providers;

use Google\Managers\Google;
use Google\Managers\GoogleManager;
use Illuminate\Support\ServiceProvider;

class GoogleServiceProvider extends ServiceProvider {
	protected $defer = false;

	/**
	 * Bootstrap the Google Configuration settings.
	 *
	 * @return void
	 */
	public function boot() {
		$this->publishes( [
			__DIR__ . '\..\config.php' => config_path( 'google.php' ),
		] );
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() {
		$this->registerGoogleManager();
	}

	/**
	 * Register Google Manager
	 */
	public function registerGoogleManager(  ) {
		$this->app->singleton( Google::class, function ( $app ) {
			return new Google();
		} );
	}
}