<?php
/**
 * =============================================================================
 * Project: Boilerplate slim
 * Created Date: 2017-11-29, 11:12:18
 * Author: Przemysław Drzewicki <przemyslaw.drzewicki@gmail.com>
 * =============================================================================
 * Last Modified: 2017-11-29, 12:32:12
 * Modified By: Przemysław Drzewicki
 * =============================================================================
 * Copyright (c) 2017 webonweb
 * =============================================================================
 */
namespace App\Console;

// =============================================================================
// Loading dependencies.
// =============================================================================
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Core class commands.
 * 
 * @category Commands
 * @copyright (C) 2017 by webonweb
 */
class Kernel extends Command
{
    /**
    * Method to configure commands.
    *
    * @access protected    
    */   
    protected function configure()
    { 
        $configuration = 
        $this
            ->setName($this->config['setting']['command'])
            ->setDescription($this->config['setting']['description']);

        foreach($this->config['arguments'] as $key => $val){
            $configuration->addArgument(
                $val['name'],
                InputArgument::OPTIONAL,
                $val['description']
            );
        }
    }

    /**
    * Method to get settings.
    *
    * @access protected    
    */   
    protected function settings($name = '')
    {   
        $dirname = dirname(__FILE__).'/../../composer.json';
        $settings = json_decode(file_get_contents($dirname), true);

        return array_key_exists($name, $settings)? $settings[$name] : "";
    }
}