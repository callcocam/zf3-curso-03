<?php

namespace TwbBundle\Options\Factory;


use Interop\Container\ContainerInterface;
use TwbBundle\Options\ModuleOptions;
use Zend\ServiceManager\Factory\FactoryInterface;

class ModuleOptionsFactory implements FactoryInterface
{

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
        $config = $container->get('Config');
        $options = $config['twbbundle'];
        return new ModuleOptions($options);
    }
}
