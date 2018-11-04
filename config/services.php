<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'tmdb' => [
        'api_key' => '7a910c69cc0be2f210022a399481d685',
        'endpoint' => 'https://api.themoviedb.org/3/search/',
        'image_endpoint' => 'http://image.tmdb.org/t/p/w342',
    ],
    'scrapers' => [
        'netflix' => [
            'id' => 'ff8599baafc292a7b074a7f54ccbc604',
            'email' => 'ff8599baafc292a7b074a7f54ccbc604@flick.com',
            'password' => '919f48bfda6fd61e303d3c23071830e8',   
        ],
        'amazon' => [
            'id' => '2d0d4809e6bdb6f4db3e547f27b1873c',
            'email' => '2d0d4809e6bdb6f4db3e547f27b1873c@flick.com',
            'password' => 'da82db635cdc4856ed4d7498476d3fc0',   
        ],
        'bbc' => [
            'id' => '99be496ab9ad1cd2b9910cecf142235a',
            'email' => '99be496ab9ad1cd2b9910cecf142235a@flick.com',
            'password' => '8aeecc1ebff23bca12df0506a908bfe3',   
        ],
        'c_four' => [
            'id' => '256ce0371bd4a05006b5226c5b1ab5a8',
            'email' => '256ce0371bd4a05006b5226c5b1ab5a8@flick.com',
            'password' => 'a53a013bc4d5653da134ee1cdb4b87fe',   
        ],
        'google' => [
            'id' => 'c822c1b63853ed273b89687ac505f9fa',
            'email' => 'c822c1b63853ed273b89687ac505f9fa@flick.com',
            'password' => '70ce481682c5551331dad7027b728b53',   
        ],
        'itunes' => [
            'id' => '3b1141027e2ed9ba7f17420a8ee707b5',
            'email' => '3b1141027e2ed9ba7f17420a8ee707b5@flick.com',
            'password' => '1ed738db1ff5c46062248ff2ac33747c',   
        ],
        'itv' => [
            'id' => '4d3c78b14533469da225cf7dd52888a1',
            'email' => '4d3c78b14533469da225cf7dd52888a1@flick.com',
            'password' => '7b25205029b90e41fbe2515b1f05eca6',   
        ],
        'rakuten' => [
            'id' => '293e166ba89b8f143f2e34e355d56f43',
            'email' => '293e166ba89b8f143f2e34e355d56f43@flick.com',
            'password' => '6038fc9f2ec690c841ceab559043385e',   
        ],
    ],
];