<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Resend, Postmark, AWS, and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'mailtrap' => [
        'api_url' => env('MAILTRAP_API_URL'),
        'token' => env('MAILTRAP_TOKEN'),
        'reservation_to' => env('RESERVATION_TO_EMAIL'),
    ],

    'strapi' => [
        'url' => env('STRAPI_URL', 'http://localhost:1337'),
        // Used to build the <img src> URLs sent to the browser. Normally the
        // same as 'url', but if php ever talks to Strapi over an internal
        // network address, that hostname means nothing to an actual browser
        // - this stays on the host-reachable address.
        'public_url' => env('STRAPI_PUBLIC_URL', env('STRAPI_URL', 'http://localhost:1337')),
        'token' => env('STRAPI_API_TOKEN'),
        'timeout' => env('STRAPI_TIMEOUT', 5),
        'cache_ttl' => env('STRAPI_CACHE_TTL', 300),
        'webhook_secret' => env('STRAPI_WEBHOOK_SECRET'),
    ],

];
