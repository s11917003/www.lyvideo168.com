<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    'mode'    => 'live', // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'username'    => env('PAYPAL_SANDBOX_API_USERNAME', 'jocelyn-facilitator_api1.richway.com.tw'),
        'password'    => env('PAYPAL_SANDBOX_API_PASSWORD', 'RYDUDM9CWRCZ28Z6'),
        'secret'      => env('PAYPAL_SANDBOX_API_SECRET', 'EH2_zmwOrl9XhlRXbs5GCsWUGoSS5uAgP5vqn3UOhCykAaJarLzE6o5LU6mMcahyn-x3h45veT_6AyiZ'),
        'certificate' => env('PAYPAL_SANDBOX_API_CERTIFICATE', 'AucW3piGs7juyeuHYb2gK9GgokmgA0yxl4adbIUiZGGazaOOX.p7LLZe'),
        'app_id'      => 'NVP SOAP Webhooks', // Used for testing Adaptive Payments API in sandbox mode
    ],
    'live' => [
        'username'    => env('PAYPAL_LIVE_API_USERNAME', 'jocelyn_api1.richway.com.tw'),
        'password'    => env('PAYPAL_LIVE_API_PASSWORD', 'YU24RNMRJ29KMBDF'),
        'secret'      => env('PAYPAL_LIVE_API_SECRET', 'EG5YgrLmJlqmCpzyt-eUvNHQRwGHoJtZZDnp2ntaZmCtWQAYk9iqILfAYME3rdEQqSGLc8cwL34e9iWE'),
        'certificate' => env('PAYPAL_LIVE_API_CERTIFICATE', 'AgchocOICa1VdBUiMeVhVZUUeywgAslbgo9Y-m4YYvNERCSOJ8.x0m4v'),
        'app_id'      => 'Braintree-1540435388779', // Used for Adaptive Payments API
    ],

    'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => 'USD',
    'billing_type'   => 'MerchantInitiatedBilling',
    'notify_url'     => '', // Change this accordingly for your application.
    'locale'         => 'en_US', // force gateway language  i.e. it_IT, es_ES, 	en_US ... (for express checkout only)
    'validate_ssl'   => true, // Validate SSL when creating api client.
];
