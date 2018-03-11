<?php
/**
 * =============================================================================
 * Project: Boilerplate slim
 * Created Date: 2017-11-08, 12:51:14
 * Author: Przemysław Drzewicki <przemyslaw.drzewicki@gmail.com>
 * =============================================================================
 * Last Modified: 2017-11-29, 12:29:03
 * Modified By: Przemysław Drzewicki
 * =============================================================================
 * Copyright (c) 2017 webonweb
 * =============================================================================
 */

namespace App\Libraries;

/**
 * Class supports input validation.
 *
 * @category Libraries
 * @copyright (C) 2017 by webonweb
 */
class Validation
{
    /**
    * A method to check if a key exists.
    *
    * @param striing $key  
    * @param array $params  
    * @param array $options     
    *
    * @access public
    * @return bolean $result
    */    
    static function required($key ='', $params = [], $options = [])
    {
        return isset($params[$key]);
    }

    /**
    * Method to check if the argument is not empty.
    *
    * @param striing $key  
    * @param array $params  
    * @param array $options     
    *
    * @access public
    * @return bolean $result
    */    
    static function not_empty($key ='', $params = [], $options = [])
    {
        return trim(@$params[$key]) != '';
    }

    /**
    * A method to check if an argument is a string.
    *
    * @param striing $key  
    * @param array $params  
    * @param array $options     
    *
    * @access public
    * @return bolean $result
    */    
    static function string($key ='', $params = [], $options = [])
    {
        return is_string(@$params[$key]);
    }

    /**
    * The method to check if an argument is an integer.
    *
    * @param striing $key  
    * @param array $params  
    * @param array $options     
    *
    * @access public
    * @return bolean $result
    */    
    static function integer($key ='', $params = [], $options = [])
    {
        return is_integer((int)@$params[$key]) && (int)@$params[$key] != 0;
    }

    /**
    * A method to check if an argument exists in
    * selected table.
    *
    * @param striing $key  
    * @param array $params  
    * @param array $options     
    *
    * @access public
    * @return bolean $result
    */    
    static function exists($key ='', $params = [], $options = [])
    {
        global $app;
        $database = $app->getContainer()->database;

        list($table, $column) = explode(',',$options[1]);

        $sql = "
                SELECT 
                    id 
                FROM ".env('DB_PREFIX').$table." 
                WHERE 
                    ".$column." = :".$column."
                LIMIT 1";

        $query = $database->prepare($sql);
        $query->execute([$column => @$params[$key]]);
        
        return ($query->rowCount() == 0)? false : true;
    }    
}