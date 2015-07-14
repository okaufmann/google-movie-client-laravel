<?php

/**
 * @package okaufmann/google-movies-client-laravel
 *
 * @author Oliver Kaufmann <support@mighty-code.com>
 * @copyright (c) 2015, Oliver Kaufmann, Mark Redeman
 */

namespace GoogleMoviesClient\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class GoogleMoviesClient extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'GoogleMoviesClient\Client';
    }
}
