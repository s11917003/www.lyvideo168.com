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
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    
    //socialite
	'google' => [
	    'client_id' => '665603339142-4o8kismcovv9hjgl72n3o0uvgmkkg340.apps.googleusercontent.com',
	    'client_secret' => 'rMHw2-LJ8SE0tkL8zDLUI5Uq',
	    'redirect' => 'https://www.c8c8tv.com/openid/google/callback',  
	],     
	'instagram' => [
	    'client_id' => 'eb74b7e859844ec292a1df7e5ba4124c',
	    'client_secret' => 'db1786dae80e4fbeb02066b7adae7c69',
	    'redirect' => 'https://www.c8c8tv.com/openid/ig/callback',  
	],     
	'twitter' => [
	    'client_id' => 'hTm4EokMhLul3EX4tUpvKYjzf',
	    'client_secret' => '44PHMruDs5BuLhFgPLH2a0g3DU2kiKxCTKAg1UFCdphsWqbVPP',
	    'redirect' => 'https://www.c8c8tv.com/openid/twitter/callback',  
	],
	'facebook' => [
	    'client_id' => '1680137345573660',
	    'client_secret' => '629ad8b9c3d811bfa706b7a6336562da',
	    'redirect' => 'https://www.c8c8tv.com/openid/facebook/callback',
	],
	'line' => [
	    'client_id' => '1575379690',
	    'client_secret' => '74d50dcb2199d6bc6cd41906c9e5aded',
	    'redirect' => 'https://www.c8c8tv.com/openid/line/callback',
	]
];
