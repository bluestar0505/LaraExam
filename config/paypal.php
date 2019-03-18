<?php

return [
    /*
      |--------------------------------------------------------------------------
      | PayPal Client id key
      |--------------------------------------------------------------------------
      |
      */
    'client_id' => env('PP_client', ''),


    /*
      |--------------------------------------------------------------------------
      | PayPal Client secret key
      |--------------------------------------------------------------------------
      |
      */
    'secret' => env('PP_secret', ''),

    /*
      |--------------------------------------------------------------------------
      | PayPal work mode
      |--------------------------------------------------------------------------
      |
      | sandbox or live
      */

    'mode' => env('PP_mode', 'sandbox'),

    /*
      |--------------------------------------------------------------------------
      | Other PayPal Preferences
      |--------------------------------------------------------------------------
      |
      */
    'service.EndPoint' => env('PP_url', 'https://api.sandbox.paypal.com'),
    'http.ConnectionTimeOut' => env('PP_timeout', 30),
    'log.LogEnabled' => env('PP_log', true),
    'log.FileName' => storage_path(env('PP_logfile', 'logs/paypal.log')),
    'log.LogLevel' => env('PP_loglevel', 'FINE')
];