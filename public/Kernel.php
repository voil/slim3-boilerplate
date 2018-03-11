<?php
/**
 * =============================================================================
 * Project: Boilerplate slim
 * Created Date: 2017-11-08, 09:52:23
 * Author: Przemysław Drzewicki <przemyslaw.drzewicki@gmail.com>
 * =============================================================================
 * Last Modified: 2017-11-29, 12:27:58
 * Modified By: Przemysław Drzewicki
 * =============================================================================
 * Copyright (c) 2017 webonweb
 * =============================================================================
 */

//==============================================================================
// Loading dependencies.
//==============================================================================
use App\Http\Requests\Outputs;

/**
 * Class of kernel platform.
 *
 * @category Kernel
 * @copyright (C) 2017 by webonweb
 */
class Kernel
{
    /**
    * Method of initializing the core of the application.
    *
    * @access public
    */  
    static function init()
    {
        $config = self::settings();

        ini_set('default_charset', $config['app']['charset']);
        ini_set('display_errors', $config['app']['errors']);
        date_default_timezone_set($config['app']['timezone']);
        session_start();
    }

    /**
    * Method to download design settings.
    *
    * @access public
    * @return array $config
    */    
    static function settings()
    {
        $settings = [];
        foreach (glob(__DIR__.'/../config/'.'*.php') as $filename) $settings[pathinfo($filename, PATHINFO_FILENAME)] = require $filename;
        $settings['notFoundHandler'] = function($c) {
            return self::notFoundHandler($c);
        };
        return $settings;
    }

    /**
    * Method to connect to a database.
    *
    * @param \Slim\App $app
    * @access public
    */ 
    static function connect(\Slim\App $app)
    {
        $database = config('database');
        $dsn = "pgsql:host=".$database['host'].";port=".$database['port'].";dbname=".$database['database'];
        try {
            $app->getContainer()->database = new PDO($dsn, 
                    $database['username'], 
                    $database['password']
            );
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            self::noRender();
        }
    }  

    /**
    * Method to catch page not found handler.
    *
    * @access public
    */  
    static function notFoundHandler($c)
    {
        return function ($request, $response) use ($c) { 
            return Outputs::output($c['response'], Outputs::badRequest());
        };
    } 

    /**
    * Method to stop page rendering.
    *
    * @access public
    */
    static private function noRender()
    {
        die();
    } 
}