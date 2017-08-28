# GoogleSupportLaravel

##Description:
Google Provides many types of API (i.e. Maps, street view, address info and more). 
calling these api's from client isn't recommended from a security perspective,
as you have to provide an API key generated by google and this key is visible on the browser.
hence, this package offers an alternative for adding a server rendering layer that hides the app key.

##Installation instructions:
run composer to install the package
- composer require jbs321/google-support-laravel

this will publish google.php config file into config/ folder 
- php artisan vendor:publish

Register Google Service Provider under 'providers'
<pre>
- \Google\Providers\GoogleServiceProvider::class,
</pre>

Register Google Facade under 'aliases'
<pre>
- 'Google' => \Google\Facades\Google::class
</pre>

