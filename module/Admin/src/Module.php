<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin;

use Admin\Form\Factory\ConfiguracaoFilterFactory;

use Admin\Form\Factory\ConfiguracaoFormFactory;

use Admin\Form\ConfiguracaoFilter;

use Admin\Form\ConfiguracaoForm;

use Admin\Model\Configuracao\Factory\ConfiguracaoFactory;

use Admin\Model\Configuracao\Factory\ConfiguracaoRepositoryFactory;

use Admin\Model\Configuracao\Configuracao;

use Admin\Model\Configuracao\ConfiguracaoRepository;

use Admin\Form\Factory\ClientesFilterFactory;

use Admin\Form\Factory\ClientesFormFactory;

use Admin\Form\ClientesFilter;

use Admin\Form\ClientesForm;

use Admin\Model\Clientes\Factory\ClientesFactory;

use Admin\Model\Clientes\Factory\ClientesRepositoryFactory;

use Admin\Model\Clientes\Clientes;

use Admin\Model\Clientes\ClientesRepository;

use Admin\Form\Factory\CategoriasFilterFactory;

use Admin\Form\Factory\CategoriasFormFactory;

use Admin\Form\CategoriasFilter;

use Admin\Form\CategoriasForm;

use Admin\Model\Categorias\Factory\CategoriasFactory;

use Admin\Model\Categorias\Factory\CategoriasRepositoryFactory;

use Admin\Model\Categorias\Categorias;

use Admin\Model\Categorias\CategoriasRepository;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

class Module implements ConfigProviderInterface, ServiceProviderInterface
{

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig()
    {
        return [
            'factories'=>[
                Configuracao::class=>ConfiguracaoFactory::class,

                ConfiguracaoRepository::class=>ConfiguracaoRepositoryFactory::class,

                ConfiguracaoForm::class=>ConfiguracaoFormFactory::class,

                ConfiguracaoFilter::class=>ConfiguracaoFilterFactory::class,

                Clientes::class=>ClientesFactory::class,

                ClientesRepository::class=>ClientesRepositoryFactory::class,

                ClientesForm::class=>ClientesFormFactory::class,

                ClientesFilter::class=>ClientesFilterFactory::class,

                Categorias::class=>CategoriasFactory::class,

                CategoriasRepository::class=>CategoriasRepositoryFactory::class,

                CategoriasForm::class=>CategoriasFormFactory::class,

                CategoriasFilter::class=>CategoriasFilterFactory::class,
            ]
        ];
    }
}
