<?php
/**
 * =============================================================================
 * Project: Boilerplate slim
 * Created Date: 2017-11-08, 09:54:56
 * Author: Przemysław Drzewicki <przemyslaw.drzewicki@gmail.com>
 * =============================================================================
 * Last Modified: 2017-11-29, 12:27:57
 * Modified By: Przemysław Drzewicki
 * =============================================================================
 * Copyright (c) 2017 webonweb
 * =============================================================================
 */
/*
|--------------------------------------------------------------------------
| Slim APP
|--------------------------------------------------------------------------
|
| Main application settings.
|
*/
return [

    /*
    |--------------------------------------------------------------------------
    | Application url.
    |--------------------------------------------------------------------------
    |
    | Set the url of the application on which it should work.
    |
    */    
    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Application key.
    |--------------------------------------------------------------------------
    |
    | Private key settings for the application.
    |
    */    
    'secret' => env('APP_SECRET', 'private_key'),

    /*
    |--------------------------------------------------------------------------
    | Timezone for application.
    |--------------------------------------------------------------------------
    |
    | Time zone settings.
    |
    */
    'timezone' => 'Europe/Warsaw',

    /*
    |--------------------------------------------------------------------------
    | Error display.
    |--------------------------------------------------------------------------
    |
    | A variable that holds the error display state for the application.
    | 1 - errors will be reported.
    | 0 - disable the error.
    |
    */
    'errors' => 1,
    
    /*
    |--------------------------------------------------------------------------
    | App encoding settings.
    |--------------------------------------------------------------------------
    |
    | A variable that stores the encoding of the application.
    |
    */
    'charset' => 'UTF-8'
];