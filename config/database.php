<?php
/**
 * =============================================================================
 * Project: Boilerplate slim
 * Created Date: 2017-11-08, 09:55:28
 * Author: Przemysław Drzewicki <przemyslaw.drzewicki@gmail.com>
 * =============================================================================
 * Last Modified: 2017-11-29, 12:28:19
 * Modified By: Przemysław Drzewicki
 * =============================================================================
 * Copyright (c) 2017 webonweb
 * =============================================================================
 */
/*
|--------------------------------------------------------------------------
| Slim DATABASE
|--------------------------------------------------------------------------
|
| Main settings for connecting to a database.
|
*/  
return [  
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '5432'),
    'database' => env('DB_DATABASE', 'forge'),
    'username' => env('DB_USERNAME', 'forge'),
    'password' => env('DB_PASSWORD', ''),
    'charset' => 'utf8'
];