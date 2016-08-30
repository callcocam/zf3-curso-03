<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 16/08/2016
 * Time: 23:52
 */

namespace Home;


use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface{

    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__.'/../config/module.config.php';
    }
}