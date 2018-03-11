<?php
/**
 * =============================================================================
 * Project: Boilerplate slim
 * Created Date: 2017-11-08, 09:51:54
 * Author: Przemysław Drzewicki <przemyslaw.drzewicki@gmail.com>
 * =============================================================================
 * Last Modified: 2017-11-29, 12:27:59
 * Modified By: Przemysław Drzewicki
 * =============================================================================
 * Copyright (c) 2017 webonweb
 * =============================================================================
 */
//==============================================================================
// Loading dependencies.
//==============================================================================
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/Helpers/Utils.php';
require __DIR__ . '/Kernel.php';

/*
|--------------------------------------------------------------------------
| Initiation of the core
|--------------------------------------------------------------------------
|
| Initialization of application core.
|
*/
Kernel::init();

/*
|--------------------------------------------------------------------------
| Load the environment
|--------------------------------------------------------------------------
|
| First, we load basic settings for the application.
|
*/
$dotenv = new Dotenv\Dotenv(__DIR__.'/..', '.'.file_get_contents(__DIR__.'/../.env').'.env');
$dotenv->load();

/*
|--------------------------------------------------------------------------
| Create an application object.
|--------------------------------------------------------------------------
|
| In the next stage we create a representative of `Slim` frameworks and the whole core
| application.
|
*/
$app = new \Slim\App(Kernel::settings());

/*
|--------------------------------------------------------------------------
| Connection to database
|--------------------------------------------------------------------------
|
| Then open the connection to the database and connect it to the root
| object `representative 'of the application.
|
*/
Kernel::connect($app);

/*
|--------------------------------------------------------------------------
| Load routing.
|--------------------------------------------------------------------------
|
| The next stage of project initialization is loading all
| routing paths.
|
*/
require __DIR__ . '/../routes/api.php';

/*
|--------------------------------------------------------------------------
| Start listening for errors.
|--------------------------------------------------------------------------
|
| Start listening for errors for the application.
|
*/
(new App\Exceptions\Handler)->init($app);

/*
|--------------------------------------------------------------------------
| Start application - ready to ROCK & ROLL!
|--------------------------------------------------------------------------
|
| At the very end, the launch of the application starts and everything is tight
| in whole.
|
*/
$app->run();