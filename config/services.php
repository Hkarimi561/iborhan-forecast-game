<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\Models\User::class,
        'key'    => env('STRIPE_KEY'),

        'secret' => env('STRIPE_SECRET'),
    ],

    'google' => [
	    'client_id' => '322438265726-uc9l5sp89303d281rkgoh25a0b19pnup.apps.googleusercontent.com',
	    'client_secret' => 'bfSO41vb0_ZMLr_z8UfR0BtI',
	    'redirect' => '/social/login/google',
    ],
    'github' => [
	    'client_id' => '4eff30cb91dfa5b6e21f',
	    'client_secret' => 'c5825bfe563c1bfe106ff20102d3d321735099cb',
	    'redirect' => '/social/login/github',
    ],

];
