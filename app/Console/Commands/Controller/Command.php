<?php
/**
 * =============================================================================
 * Project: Boilerplate slim
 * Created Date: 2017-11-29, 11:43:21
 * Author: Przemysław Drzewicki <przemyslaw.drzewicki@gmail.com>
 * =============================================================================
 * Last Modified: 2017-11-29, 12:31:48
 * Modified By: Przemysław Drzewicki
 * =============================================================================
 * Copyright (c) 2017 webonweb
 * =============================================================================
 */

namespace App\Console\Commands\Controller;

//==============================================================================
// Loading dependencies.
//==============================================================================
use App\Console\Kernel;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class of command.
 * 
 * @category Commands
 * @copyright (C) 2017 by webonweb
 */
class Command extends Kernel
{

    /**
    * A variable oc configuration command.
    *
    * @var array
    */  
    protected $config = [
        'setting' => [
            'command'     => 'controller:create',
            'description' => 'Create dynamical controller for platform.'
        ],
        'arguments' => [
            [ 
                'name' => 'name',
                'description' => 'Name of controller class'
            ],
            [ 
                'name' => 'actions',
                'description' => 'Actions to create in controller.'
            ]
        ]
    ];

    /**
    * Method for clearing input keys.
    *
    * @param InputInterface $input     
    * @param OutputInterface $output  
    *
    * @access protected
    */  
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name    = $input->getArgument('name');
        $actions = $input->getArgument('actions');

        $dirname = dirname(__FILE__).'/';
        $method = file_get_contents($dirname.'Method.tpl');

        $template = file_get_contents($dirname.'Controller.tpl');
        $template = str_replace('<<project>>', $this->settings('name'), $template);
        $template = str_replace('<<author>>', $this->settings('author'), $template);
        $template = str_replace('<<company>>', $this->settings('company'), $template);
        $template = str_replace('<<created_at>>', (new \DateTime())->format('Y-m-d H:m:s'), $template);
        $template = str_replace('<<year>>', (new \DateTime())->format('Y'), $template);
        $template = str_replace('<<name>>', ucfirst($name), $template);
        $template = str_replace('<<methods>>', $this->preapreMethods($actions), $template);

        file_put_contents($dirname.'../../../Http/Controllers/'.ucfirst($name).'.php', $template);

        $output->writeln('Controller created success');
    }

    /**
    * Method for prepare methods controller.
    *
    * @param string $actions     
    *
    * @access private
    * @return string $methods
    */ 
    private function preapreMethods($actions = '')
    {
      $actions = explode(',', $actions);
      if(@$actions[0] == ''){ return ''; }

      $dirname = dirname(__FILE__).'/';
      $method = file_get_contents($dirname.'Method.tpl');

      $methods = '';
      $methods = implode("\n\n", array_map(function($item) use($method){
        return str_replace('<<name>>', $item, $method);
      }, $actions));

      return $methods;
    }
}
