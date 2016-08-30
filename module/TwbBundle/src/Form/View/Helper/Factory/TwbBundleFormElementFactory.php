<?php

namespace TwbBundle\Form\View\Helper\Factory;

use Interop\Container\ContainerInterface;
use TwbBundle\Form\View\Helper\TwbBundleFormElement;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Factory to inject the ModuleOptions hard dependency
 *
 * @author Fábio Carneiro <fahecs@gmail.com>
 * @license MIT
 */
class TwbBundleFormElementFactory implements FactoryInterface
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
        $options = $container->get('TwbBundle\Options\ModuleOptions');
        return new TwbBundleFormElement($options);
    }
}
