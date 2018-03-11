<?php
/**
 * =============================================================================
 * Project: Boilerplate slim
 * Created Date: 2017-11-29, 11:43:21
 * Author: Przemysław Drzewicki <przemyslaw.drzewicki@gmail.com>
 * =============================================================================
 * Last Modified: 2017-11-29, 12:32:09
 * Modified By: Przemysław Drzewicki
 * =============================================================================
 * Copyright (c) 2017 webonweb
 * =============================================================================
 */

namespace App\Console\Commands\Model;

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
            'command'     => 'model:create',
            'description' => 'Create dynamical model for platform.'
        ],
        'arguments' => [
            [ 
                'name' => 'name',
                'description' => 'Name of controller class'
            ],
            [ 
                'name' => 'table',
                'description' => 'Name of table connection'
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
        $table    = $input->getArgument('table');

        $dirname = dirname(__FILE__).'/';
        $template = file_get_contents($dirname.'Model.tpl');
        $template = str_replace('<<project>>', $this->settings('name'), $template);
        $template = str_replace('<<author>>', $this->settings('author'), $template);
        $template = str_replace('<<company>>', $this->settings('company'), $template);
        $template = str_replace('<<created_at>>', (new \DateTime())->format('Y-m-d H:m:s'), $template);
        $template = str_replace('<<year>>', (new \DateTime())->format('Y'), $template);
        $template = str_replace('<<name>>', ucfirst($name), $template);
        $template = str_replace('<<table>>', ucfirst($table), $template);

        file_put_contents($dirname.'../../../Models/'.ucfirst($name).'.php', $template);

        $output->writeln('Model created success');
    }
}
