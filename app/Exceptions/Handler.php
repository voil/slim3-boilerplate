<?php
/**
 * =============================================================================
 * Project: Boilerplate slim
 * Created Date: 2017-11-08, 10:32:41
 * Author: Przemysław Drzewicki <przemyslaw.drzewicki@gmail.com>
 * =============================================================================
 * Last Modified: 2017-11-29, 12:30:44
 * Modified By: Przemysław Drzewicki
 * =============================================================================
 * Copyright (c) 2017 webonweb
 * =============================================================================
 */

namespace App\Exceptions;

//==============================================================================
// Loading dependencies
//==============================================================================
use App\Http\Requests\Outputs;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Exception class.
 *
 * @category Exceptions.
 * @copyright (C) 2017 by webonweb
 */
class Handler
{
    /**   
     * Thread override for `Slim`.
     *
     * @param  \Slim\App $app
     * @access public
     */
    public function init(\Slim\App $app)
    {
        $container = $app->getContainer();
        $container['errorHandler'] = function ($app) {
            return function ($request, $response, $exception) use ($app) {
                return $this->error($app);
            };
        };
    }

    /**
     * The method that catches the error in the application.
     *
     * @param  \Slim\App $app
     * @access public
     */
    private function error($app)
    {
        return Outputs::output($app->response, Outputs::internalServerError());
    }  
}