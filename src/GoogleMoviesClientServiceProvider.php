<?php

/**
 * @package okaufmann/google-movies-client-laravel
 *
 * @author Oliver Kaufmann <support@mighty-code.com>
 * @copyright (c) 2015, Oliver Kaufmann, Mark Redeman
 */

namespace GoogleMoviesClient\Laravel;

use GoogleMoviesClient\Client;
use Illuminate\Support\ServiceProvider;

class GoogleMoviesClientServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Actual provider.
     *
     * @var \Illuminate\Support\ServiceProvider
     */
    protected $provider;

    /**
     * Construct the GoogleMoviesClient service provider.
     */
    public function __construct()
    {
        // Call the parent constructor with all provided arguments
        $arguments = func_get_args();
        call_user_func_array(
            [$this, 'parent::' . __FUNCTION__],
            $arguments
        );

        $this->registerProvider();
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->provider->boot();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Configure any bindings that are version dependent
        $this->provider->register();

        // Let the IoC container be able to make a Symfony event dispatcher
        $this->app->bind(
            'Symfony\Component\EventDispatcher\EventDispatcherInterface',
            'Symfony\Component\EventDispatcher\EventDispatcher'
        );

        // Setup default configurations for the GoogleMoviesClient Client
        $this->app->bindShared('GoogleMoviesClient\Client', function () {
            $config = $this->provider->config();
            $options = $config['options'];

            // Use an Event Dispatcher that uses the Laravel event dispatcher
            $options['event_dispatcher'] = $this->app->make('GoogleMoviesClient\Laravel\Adapters\EventDispatcherAdapter');

            return new Client($options);
        });
    }

    /**
     * Register the ServiceProvider according to Laravel version.
     */
    private function registerProvider()
    {
        $app = $this->app;

        // Pick the correct service provider for the current verison of Laravel
        $this->provider = new GoogleMoviesClientServiceProviderLaravel($app);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['gmc'];
    }
}
