<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Business / Contact Information
    |--------------------------------------------------------------------------
    |
    | Centralized business-identifying values so they're never hardcoded across
    | Blade templates. All values below are placeholders — the real Urooj Tech
    | business information will be provided later and should be set via the
    | corresponding BUSINESS_* environment variables, not by editing this file.
    |
    */

    'name' => env('BUSINESS_NAME', 'Urooj Tech'),

    'email' => env('BUSINESS_EMAIL', 'support@uroojtech.example'),

    'phone' => env('BUSINESS_PHONE', '+1 (555) 000-0000'),

    'address' => env('BUSINESS_ADDRESS', '123 Placeholder Street, Suite 100, City, Country'),

    'hours' => env('BUSINESS_HOURS', 'Mon–Fri, 9:00 AM – 6:00 PM'),

    'social' => [
        'facebook' => env('BUSINESS_SOCIAL_FACEBOOK'),
        'instagram' => env('BUSINESS_SOCIAL_INSTAGRAM'),
        'twitter' => env('BUSINESS_SOCIAL_TWITTER'),
        'linkedin' => env('BUSINESS_SOCIAL_LINKEDIN'),
    ],

];
