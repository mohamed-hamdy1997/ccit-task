<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'twilio' => [
        'sid' => env('TWILIO_SID', 'ACf7626314ef819afd02b96141ec6021fb'),
        'token' => env('TWILIO_TOKEN', '3587d6211dafc0018992e999d3a3fb7a'),
        'phone_number' => env('TWILIO_NUMBER', '+13155414495'),
    ],

    'moyasar' => [
        'secret_key' => env('MOYASAR_SECRET_KEY', 'sk_test_VZcv3AD9mX8k8FCrj33PAxvPkUrmheQKBzr46EBd'),
        'public_key' => env('MOYASAR_PUBLIC_KEY', 'pk_test_wyFTAXjvdMbp5bdLgmDkegVyPsUoVBBY5oGfEkvc'),
    ],
];
