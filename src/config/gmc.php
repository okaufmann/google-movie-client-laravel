<?php

/**
 * @package okaufmann/google-movies-client-laravel
 *
 * @author Oliver Kaufmann <support@mighty-code.com>
 * @copyright (c) 2015, Oliver Kaufmann, Mark Redeman
 */

return [
    'options' => [
        /*
         * Cache
         */
        'cache' => [
            'enabled' => true,
            // Keep the path empty or remove it entirely to default to storage/tmdb
            'path'    => storage_path('gmc'),
        ],
        /*
         * Log
         */
        'log'   => [
            'enabled' => true,
            // Keep the path empty or remove it entirely to default to storage/logs/tmdb.log
            'path'    => storage_path('logs/gmc.log'),
        ],
    ],
];
