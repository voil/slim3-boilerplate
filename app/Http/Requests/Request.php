<?php
/**
 * =============================================================================
 * Project: Boilerplate slim
 * Created Date: 2017-11-08, 12:44:33
 * Author: Przemysław Drzewicki <przemyslaw.drzewicki@gmail.com>
 * =============================================================================
 * Last Modified: 2017-11-29, 12:29:18
 * Modified By: Przemysław Drzewicki
 * =============================================================================
 * Copyright (c) 2017 webonweb
 * =============================================================================
 */

namespace App\Http\Requests;

// =============================================================================
// Loading dependencies.
// =============================================================================
use App\Http\Requests\Outputs;

/**
 * Abstract class for resolve requests.
 *
 * @category Request
 * @copyright (C) 2017 by webonweb
 */
abstract class Request
{
    /**
    * @var array
    *
    * A variable that holds all verses.
    */   
    private $errors = [];

    /**
     * Launch the request method.
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @access public 
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke($request, $response, $next)
    {
        $params  = $this->all($request);
        $isValid = $this->isValid($params);

        $request = ($isValid)? $request->withAttribute('params', $params) : $request;
        $this->response = ($isValid)? $this->response : Outputs::notAcceptable($this->errors);

        return (!$isValid)? Outputs::output($response) : $next($request, $response);
    }

    /**      
     * Retrieving all input data and pasting them
     * to access data.
     *
     * @access public         
     * @return array
     */
    public function all($request)
    {   
        $params = $request->getParsedBody()? $request->getParsedBody() : [];
        
        $arguments = array_merge($request->getAttribute('route')->getArguments(), $params, $_GET);
        return array_intersect_key($arguments, array_flip($this->allowed));
    }

    /**     
     * Check all input and validate their correctness.
     *
     * @param array $params
     *
     * @access private 
     * @return boolean true/false
     */
    private function isValid($params = [])
    {   
        foreach($this->rules() as $key => $item){
            foreach(explode('|', $item) as $keyRule => $rule){
                $parts = explode(':', $rule);
                $result = \App\Libraries\Validation::{$parts[0]}($key, $params, $parts);
                $this->addError($result, $key, $parts[0]);
            }
        }
        return count($this->errors) == 0? true : false;
    }

    /**      
     * Add an error table if exists.
     *
     * @param boolean $result
     * @param string $ket
     * @param string $rule
     *
     * @access private 
     */
    private function addError($result = false, $key = '', $rule = '')
    {
        if(!$result){
            $this->errors[$key] = (!isset($this->errors[$key]))? [] : $this->errors[$key];
            array_push($this->errors[$key], $this->messages()[$key.'.'.$rule]);
        } 
    }
}