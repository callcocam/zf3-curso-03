<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 17/08/2016
 * Time: 00:23
 */

namespace Admin\Controller\Factory;


use Admin\Controller\AdminController;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class AdminControllerFactory implements FactoryInterface {

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
      */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        return new AdminController($container);
    }
}