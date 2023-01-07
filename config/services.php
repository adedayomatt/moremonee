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

    "flutterwave" => [
        "api_base_url" => env('FLW_API_BASE_URL'),
        "public_key" => env('FLW_PUBLIC_KEY'),
        "secret_key" => env('FLW_SECRET_KEY'),
        "encryption_key" => env('FLW_ENCRYPTION_KEY'),
]


];
