<?php

/**
 * @package okaufmann/google-movies-client-laravel
 *
 * @author Oliver Kaufmann <support@mighty-code.com>
 * @copyright (c) 2015, Oliver Kaufmann, Mark Redeman
 */

namespace GoogleMoviesClient\Laravel;

use Illuminate\Support\ServiceProvider;

class GoogleMoviesClientServiceProviderLaravel extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            $this->defaultConfig() => config_path('gmc.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->setupConfiguration();

        $this->app->bind('GoogleMoviesClient\Laravel\Adapters\EventDispatcherAdapter',
            'GoogleMoviesClient\Laravel\Adapters\EventDispatcherLaravel');
    }

    /**
     * Get the Google Movies Client configuration from the config repository.
     *
     * @return array
     */
    public function config()
    {
        return $this->app['config']->get('gmc');
    }

    /**
     * Setup configuration.
     *
     * @return void
     */
    private function setupConfiguration()
    {
        $config = $this->defaultConfig();
        $this->mergeConfigFrom($config, 'gmc');
    }

    /**
     * Returns the default configuration path.
     *
     * @return string
     */
    private function defaultConfig()
    {
        return __DIR__ . '/config/gmc.php';
    }
}
