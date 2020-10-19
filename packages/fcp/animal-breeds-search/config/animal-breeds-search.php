<?php

return [

    /*
    |--------------------------------------------------------------------------
    |  Api Services General Options
    |--------------------------------------------------------------------------
    |
    | General settings that apply to all services and the option to set the default service
    |
    */
    'service'     => env('ANIMAL_API_SERVICE', 'thecatapi'),
    'timeout'     => env('ANIMAL_API_SERVICE_CONNECTION_TIMEOUT', 3),

    /*
    |--------------------------------------------------------------------------
    | Api Services
    |--------------------------------------------------------------------------
    |
    | Here you can configure the required properties for each api service
    | used by the package.
    |
    | Services: "thecatapi", "thedogapi"
    |
    */
    'services'    => [
        'thecatapi' => [
            'api_key'      => env('CAT_API_KEY', ''),
            'endpoint'     => env('CAT_API_ENDPOINT', 'https://api.thecatapi.com'),
            'version'      => env('CAT_API_VERSION', 'v1'),
        ],
        'thedogapi' => [
            'api_key'      => env('DOG_API_KEY', ''),
            'endpoint'     => env('DOG_API_ENDPOINT', 'https://api.thedogapi.com'),
            'version'      => env('DOG_API_VERSION', 'v1'),
        ],
    ],
];
