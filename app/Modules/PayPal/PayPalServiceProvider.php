<?php
namespace App\Modules\PayPal;

use Illuminate\Support\ServiceProvider;
use Exception;

class PayPalServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('PayPal', function ($app) {
            return new PayPal($this->getConfig());
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('PayPal');
    }

    public function getConfig()
    {
        if (!$this->app['config']['paypal']) {
            throw new Exception('PayPal Config not found. Check if app/config/paypal.php');
        }

        return $this->app['config']['paypal'];
    }

}
