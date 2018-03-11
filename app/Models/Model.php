<?php
/**
 * =============================================================================
 * Project: Boilerplate slim
 * Created Date: 2017-11-08, 11:26:21
 * Author: Przemysław Drzewicki <przemyslaw.drzewicki@gmail.com>
 * =============================================================================
 * Last Modified: 2017-11-29, 12:28:40
 * Modified By: Przemysław Drzewicki
 * =============================================================================
 * Copyright (c) 2017 webonweb
 * =============================================================================
 */

namespace App\Models;

/**
 * Core class models.
 *
 * @category Model
 * @copyright (C) 2017 by webonweb
 */
class Model
{
    /**
    * A variable that stores references to a database.
    *
    * @var array
    */    
    static protected $database;

    /**
    * Columns to be retrieved from the database.
    *
    * @var array
    */    
    static protected $fill = [];

    /**
    * Class constructor.
    */    
    function __construct()
    {
        global $app;
        self::$database = $app->getContainer()->database;
    }

    /**
    * Method to return database instance.
    *
    * @access protected    
    */   
    static protected function database() {
        return $GLOBALS['app']->getContainer()->database;
    }

    /**
    * Method for clearing input keys.
    *
    * @param array $criteria     
    *
    * @access protected
    * @return string $params
    */  
    static protected function parseCriteria($criteria = [], $prefix = '')
    {   
        $criteria = array_map(function($item) use($prefix){
            $parts = explode('.', $item);
            return (count($parts) > 1)? $prefix.$item.' = :'.$parts[1] : $prefix.$item.' = :'.$item;
        }, array_keys($criteria));        

        return implode(' AND ', $criteria);
    }  

    /**
    * A method to overwrite insert input.
    *
    * @param array $params     
    *
    * @access protected
    * @return string $values
    */  
    static protected function parsedValues($params = [])
    {
        return implode(",",array_map(function($item){ return ":".$item; }, array_keys($params)));
    }  

    /**
    * A method to prepare update params.
    *
    * @param array $params     
    *
    * @access protected
    * @return string $values
    */  
    static protected function preapreUpdateParams($params = [])
    {
        return implode(",",array_map(function($item){ return $item."=:".$item; }, array_keys($params)));
    }

    /**
    * A method to prepare fill params.
    *
    * @param array $params  
    * @param array $fill     
    *
    * @access protected
    * @return string $values
    */  
    static protected function parseFillParams($params = [], $fill = [])
    {   
        $paramsParsed = [];
        foreach($params as $key => $val){
            if(in_array($key, $fill)){
                $paramsParsed[$key] = $val;
            }
        }

        return $paramsParsed;
    }

    /**
    * A method to overwrite insert input.
    *
    * @param array $params     
    *
    * @access protected
    * @return string $values
    */  
    static protected function parsedKeys($params = [])
    {
        return implode(",",array_keys($params));
    }   

    /**
    * Method writes sql from transaction.
    *
    * @access protected    
    */   
    protected function save()
    {
        self::$database->commit();
    } 

    /**
    * Method to undo changes on the database.
    *
    * @access protected    
    */ 
    protected function back()
    {
        self::$database->rollBack();
    }
}