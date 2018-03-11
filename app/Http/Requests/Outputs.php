<?php
/**
 * =============================================================================
 * Project: Boilerplate slim
 * Created Date: 2017-11-08, 10:35:18
 * Author: Przemysław Drzewicki <przemyslaw.drzewicki@gmail.com>
 * =============================================================================
 * Last Modified: 2017-11-29, 12:30:09
 * Modified By: Przemysław Drzewicki
 * =============================================================================
 * Copyright (c) 2017 webonweb
 * =============================================================================
 */

namespace App\Http\Requests;

/**
 * Response class for controllers.
 *
 * @category Requests.
 * @copyright (C) 2017 by webonweb
 */
class Outputs
{
    /**
    * @var array
    *
    * A variable that holds an example of a verse.
    */    
    static protected $response = [
        'data'      =>  [],
        'code'      =>  200,
        'message'   =>  ''
    ];

    /**  
     * Get the answer when the message 'not_acceptable'.
     *
     * @param  array $errors
     *
     * @access public
     * @return array $response
     */
    static public function notAcceptable($errors = [])
    {
        self::$response['code'] = 406;
        self::$response['data'] = $errors;
        self::$response['message'] = 'not_acceptable';

        return self::$response;
    }

    /**  
     * Get the response when the message is "forbidden".
     *
     * @access public
     * @return array $response
     */
    static public function forbidden()
    {
        self::$response['code'] = 404;
        self::$response['message'] = 'forbidden';

        return self::$response;
    }

    /**   
     * Get the response when the message is "forbidden".
     *
     * @access public
     * @return array $response
     */
    static public function internalServerError()
    {
        self::$response['code'] = 500;
        self::$response['message'] = 'internal_server_error';

        return self::$response;
    }

    /**  
     * Get the response when the message is "unauthorized".
     *
     * @access public
     * @return array $response
     */
    static public function unauthorized()
    {
        self::$response['code'] = 401;
        self::$response['message'] = 'unauthorized';

        return self::$response;
    } 

    /**  
     * Get the response when the message is "success".
     *
     * @access public
     * @return array $response
     */
    static public function success($data = [])
    {
        self::$response['code'] = 200;
        self::$response['data'] = $data;
        self::$response['message'] = 'success';

        return self::$response;
    }  

    /**  
     * Get the answer when the message 'not_found'.
     *
     * @access public
     * @return array $response
     */
    static public function notFound()
    {
        self::$response['code'] = 404;
        self::$response['message'] = 'not_found';

        return self::$response;
    }   

    /**  
     * Get the answer when the message 'bad_request'.
     *
     * @access public
     * @return array $response
     */
    static public function badRequest()
    {
        self::$response['code'] = 400;
        self::$response['message'] = 'bad_request';

        return self::$response;
    } 

    /**
    * Method of returning the answer.
    *
    * @param ResponseInterface $response
    * @access public
    */
    static public function output($response, $data = [])
    {
        return $response->withHeader('Content-type', 'application/json')
                        ->withJson(self::$response, self::$response['code']);
    } 
}