<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 27/08/2016
 * Time: 10:52
 */

namespace Auth\Storage\Factory;


use Auth\Storage\AuthStorage;
use Auth\Storage\IdentityManager;
use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Db\Adapter\AdapterInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter as AuthAdapter;
class IdentityManagerFactory implements FactoryInterface{

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
        // Configure the instance with constructor parameters:
        $Myconfig=$container->get("ZfConfig");
        $dbAdapter =$container->get(AdapterInterface::class);
        $dbTableAuthAdapter = new AuthAdapter($dbAdapter,
            'bs_users',
            'email',
            'password',
            "MD5('{$Myconfig->staticsalt}') AND state = 0");
        $authService = new AuthenticationService();
        $authService->setAdapter($dbTableAuthAdapter);
        $authService->setStorage($container->get(AuthStorage::class));
        return new IdentityManager($authService);
    }
}