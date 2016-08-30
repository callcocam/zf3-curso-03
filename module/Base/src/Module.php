<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 17/08/2016
 * Time: 00:10
 */

namespace Base;




use Admin\Model\Configuracao\ConfiguracaoRepository;
use Base\Controller\Plugin\Messages;
use Base\Controller\Plugin\SigaContas;
use Base\Form\BuscaForm;
use Base\Form\Factory\BuscaFactory;
use Base\Model\Cache;
use Base\Model\Factory\CacheFactory;
use Base\Services\Client;
use Base\Services\Factory\ClientHttpFactory;
use Base\View\Helper\NavigationHelper;
use Base\View\Helper\SearchHelper;
use Interop\Container\ContainerInterface;
use Zend\Config\Config;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module implements BootstrapListenerInterface, ConfigProviderInterface, ServiceProviderInterface, ViewHelperProviderInterface{

    const VERSION = '3.0.2dev';
    /**
     * Listen to the bootstrap event
     *
     * @param EventInterface $e
     * @return array
     */
    public function onBootstrap(EventInterface $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $eventManager->attach(MvcEvent::EVENT_DISPATCH, array($this, 'onDispatch'), 0);
        $eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR, array($this, 'onDispatchError'), 0);
        $eventManager->attach(MvcEvent::EVENT_RENDER_ERROR, array($this, 'onRenderError'), 0);

    }


    public function onDispatchError(MvcEvent $e){
        $statusCode = $e->getResponse()->getStatusCode();
        if ($statusCode == 404 || $statusCode == 500) {
            $viewModel = $e->getViewModel();
            $viewModel->setTemplate('layout/error');
        }
    }
    public function onRenderError($e){

    }

    public function onDispatch($e){
        $cache=new Cache();
        if(!$cache->hasItem('issusers')){
            $repository= $e->getApplication()->getServiceManager()->get(ConfiguracaoRepository::class);
            /**
             * @var $user IdentityManager
             */
           // $user= $e->getApplication()->getServiceManager()->get(IdentityManager::class);
           // if($user->hasIdentity()){
           //     $issuser=$repository->find($user->hasIdentity()->empresa,false);
           // }
           // else{
                $issuser=$repository->find('1',false);
          //  }
            if($issuser->getResult()){
                $cache->setItem('issusers',$issuser->getData());
            }
        }
        $config = $e->getApplication()->getServiceManager()->get('config');
        $layout_map = $config["view_manager"]["template_map"];
        $controller = $e->getTarget();

        if (!$controller) {
            $controller = $e->getRouteMatch()->getParam('controller');
        }
        //Pegar o layout pelo controller
        $controller_class = get_class($controller);
        //Pega pelo namespace
        $module_namespace = substr($controller_class, 0, strpos($controller_class, '\\'));
        $controller_class = strtolower(str_replace("\\", "_", $controller_class));
        //Pela action
        $action = $e->getRouteMatch()->getParam('action');


        // \Base\Model\Check::debug(array($layout_map,$module_namespace,$controller_class,$action),"p");


        if (array_key_exists(sprintf("%s/layout", strtolower($module_namespace)), $layout_map)) {
            $controller->layout(sprintf("%s/layout", strtolower($module_namespace)));
        }

        if (array_key_exists(sprintf("%s/layout", strtolower($controller_class)), $layout_map)) {
            $controller->layout(sprintf("%s/layout", strtolower($controller_class)));
        }

        if (array_key_exists(sprintf("%s/layout", strtolower($action)), $layout_map)) {
            $controller->layout(sprintf("%s/layout", strtolower($action)));
        }
        $id = $e->getRouteMatch()->getParam('id', null);
        if (!is_null($id)) {

        }
    }

    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
       return include __DIR__.'/../config/module.config.php';
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
               'Messages'=>Messages::class,
                SigaContas::class=>SigaContas::class,
                Cache::class=>CacheFactory::class,
                Client::class=>ClientHttpFactory::class,
                BuscaForm::class=>BuscaFactory::class,
                "ZfConfig"=>function(ContainerInterface $containerInterface){
                    $config=$containerInterface->get('config');
                    return new Config($config['zf-config']);
                }
            ]
        ];
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getViewHelperConfig()
    {
        return [
            'invokables'=>[
                 'CacheHelper' => 'Base\View\Helper\CacheHelper',

            ],
            'factories'=>[
                   'messages' => function (ContainerInterface $container) {
                    $messagesPlugin = $container->get('ControllerPluginManager')->get('Messages');
                    $messages = $messagesPlugin->getMergedMessages();
                    $helper = new \Base\View\Helper\Messages($messages);
                    return $helper;
                },
                'MyNavigation'=>function(){
                    return new NavigationHelper();
                },
                'Search'=>function(ContainerInterface $containerInterface){
                    return new SearchHelper($containerInterface);
                }


            ],

        ];
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getControllerPluginConfig()
    {
        return [
            'invokables'=>[
                'Messages'=>Messages::class,
                'SigaContas'=>SigaContas::class

            ],
            'factories'=>[

            ]
        ];
    }
}