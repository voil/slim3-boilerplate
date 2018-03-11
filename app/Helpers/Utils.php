<?php
/**
 * =============================================================================
 * Project: Boilerplate slim
 * Created Date: 2017-11-08, 10:21:06
 * Author: Przemysław Drzewicki <przemyslaw.drzewicki@gmail.com>
 * =============================================================================
 * Last Modified: 2017-11-29, 12:30:26
 * Modified By: Przemysław Drzewicki
 * =============================================================================
 * Copyright (c) 2017 webonweb
 * =============================================================================
 */

if (!function_exists('env'))
{
  /**
    * env
    *
    * Function to get the config environment.
    *
    * @param  string $key
    *
    * @return string $replacement
    */
  function env($key = '', $replacement = '')
  {
      return (!getenv($key))? (trim($replacement) == ''? false : $replacement) : getenv($key);
  }
}


if (!function_exists('config'))
{
  /**
    * config
    *
    * Function to get configuration value.
    *
    * @param  string $needle
    *
    * @return string $config
    */
  function config($needle = '')
  {
    global $app;
    $base  = explode('.', $needle);
    $step = $app->getContainer();
    foreach($base as $key => $item){
      $step = steps($step, $item);
    }

    return $step;
  }

  /**
    * steps
    *
    * Function to get a step.
    *
    * @param  array $container
    * @param  string $search
    *
    * @return string $seatch
    */
	function steps($container = [], $search = '')
	{
		try{
			return $container[$search];
		} catch (Exception $e) {
			return false;
		}
	}
}