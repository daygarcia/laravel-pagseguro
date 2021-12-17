<?php


return [

    /*
    |--------------------------------------------------------------------------
    | Default PagSeguro configs  
    |--------------------------------------------------------------------------
    |
    | This option is the default configs for the PagSeguro.
    | 
    |
    */

    'email'     => env('PAGSEGURO_EMAIL'),
    'token'     => env('PAGSEGURO_TOKEN'),
    'sandbox'   => env('PAGSEGURO_SANDBOX', true),
    'host'      => array(
        'sandbox'           => 'https://ws.sandbox.pagseguro.uol.com.br/',
        'production'        => 'https://ws.pagseguro.uol.com.br/',
        'soap_sandbox'      => 'https://ws.sandbox.pagseguro.uol.com.br/',
        'soap_production'   => 'https://ws.pagseguro.uol.com.br/',
    ),
];
