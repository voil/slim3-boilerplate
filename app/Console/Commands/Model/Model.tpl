<?php
/**
 * =============================================================================
 * Project: <<project>>
 * Created Date: <<created_at>>
 * Author: <<author>>
 * =============================================================================
 * Last Modified: <<created_at>>
 * Modified By: <<author>>
 * =============================================================================
 * Copyright (c) <<year>> by <<company>>
 * =============================================================================
 */

namespace App\Models;

//==============================================================================
// Loading dependencies.
//==============================================================================\
use App\Models\Model as BaseModel;

/**
 * Class to support model.
 * @category Model
 *
 * @copyright (C) <<year>> by <<company>>
 */
class <<name>> extends BaseModel
{
  /**
  * Table to be handled when downloading data.
  *
  * @var string
  */    
  static private $table = "<<table>>";

  /**
  * The amount of data displayed on the page.
  *
  * @var string
  */    
  static private $onPage = 25;

  /**
  * Columns to be retrieved from the database.
  *
  * @var array
  */    
  static private $columns = [];

  /**
  * Columns to be retrieved from the database.
  *
  * @var array
  */    
  static protected $fill = [];
}