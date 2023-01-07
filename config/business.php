<?php

return [
    'name' => env('APP_NAME', 'MoreMonee'),
    'logo' => env("LOGO_URL"),
    'website' => env("WEBSITE"),
    'currency' => env("DEFAULT_CURRENCY", 'USD'),
    'currencies' => explode(",",env("SUPPORTED_CURRENCIES", "")),
    'instagram' => env("INSTAGRAM_URL"),
    'facebook' => env("FACEBOOK_URL"),
    'whatsapp' => env("WHATSAPP_URL"),
    'allowed_cross_origin_domains' => explode(",",env("ALLOWED_CROSS_ORIGIN_DOMAINS", "")),
    'enable_multiple_currency' => env("ENABLE_MULTIPLE_CURRENCY", false),
];
