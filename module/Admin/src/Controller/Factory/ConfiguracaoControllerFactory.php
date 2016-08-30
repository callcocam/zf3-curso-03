<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Admin\Controller\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Admin\Controller\ConfiguracaoController;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class ConfiguracaoControllerFactory implements FactoryInterface
{

    /**
     * __invoke Factory Controller
     *
     * @return __invoke
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // Configurações iniciais do Factory Controller
        return new ConfiguracaoController($container);
    }


}

