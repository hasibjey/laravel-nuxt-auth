<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    */

    // Which paths should accept CORS requests
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    // Allowed HTTP methods
    'allowed_methods' => ['*'],

    // Allowed origins
    'allowed_origins' => ['http://localhost:3000'],

    // Patterns for allowed origins (optional)
    'allowed_origins_patterns' => [],

    // Allowed headers in requests
    'allowed_headers' => ['*'],

    // Headers exposed to the browser
    'exposed_headers' => [],

    // Max age for preflight requests
    'max_age' => 0,

    // Allow credentials (cookies, auth headers)
    'supports_credentials' => true,
];
