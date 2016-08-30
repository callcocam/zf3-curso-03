<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 17/08/2016
 * Time: 00:56
 */

namespace Auth;

use Auth\Acl\Acl;
use Auth\Acl\Factory\AclFactory;
use Auth\Controller\Plugin\IsAllowed;
use Auth\Form\AuthFilter;
use Auth\Form\AuthForm;
use Auth\Form\Factory\AuthFilterFactory;
use Auth\Form\Factory\AuthFormFactory;
use Auth\Form\Factory\ProfileFilterFactory;
use Auth\Form\Factory\ProfileFormFactory;
use Auth\Form\Factory\ResourcesFilterFactory;

use Auth\Form\Factory\ResourcesFormFactory;

use Auth\Form\Factory\UpdatePasswordFilterFactory;
use Auth\Form\Factory\UpdatePasswordFormFactory;
use Auth\Form\ProfileFilter;
use Auth\Form\ProfileForm;
use Auth\Form\ResourcesFilter;

use Auth\Form\ResourcesForm;

use Auth\Form\UpdatePasswordFilter;
use Auth\Form\UpdatePasswordForm;
use Auth\Model\Resources\Factory\ResourcesFactory;

use Auth\Model\Resources\Factory\ResourcesRepositoryFactory;

use Auth\Model\Resources\Resources;

use Auth\Model\Resources\ResourcesRepository;

use Auth\Form\Factory\PrivilegesFilterFactory;

use Auth\Form\Factory\PrivilegesFormFactory;

use Auth\Form\PrivilegesFilter;

use Auth\Form\PrivilegesForm;

use Auth\Model\Privileges\Factory\PrivilegesFactory;

use Auth\Model\Privileges\Factory\PrivilegesRepositoryFactory;

use Auth\Model\Privileges\Privileges;

use Auth\Model\Privileges\PrivilegesRepository;

use Auth\Form\Factory\RolesFilterFactory;

use Auth\Form\Factory\RolesFormFactory;

use Auth\Form\RolesFilter;

use Auth\Form\RolesForm;

use Auth\Model\Roles\Factory\RolesFactory;

use Auth\Model\Roles\Factory\RolesRepositoryFactory;

use Auth\Model\Roles\Roles;

use Auth\Model\Roles\RolesRepository;

use Auth\Form\Factory\UsersFilterFactory;

use Auth\Form\Factory\UsersFormFactory;

use Auth\Form\UsersFilter;

use Auth\Form\UsersForm;

use Auth\Model\Users\AuthRepository;
use Auth\Model\Users\Factory\AuthRepositoryFactory;
use Auth\Model\Users\Factory\UsersFactory;

use Auth\Model\Users\Factory\UsersRepositoryFactory;

use Auth\Model\Users\Users;

use Auth\Model\Users\UsersRepository;

use Auth\Storage\AuthStorage;
use Auth\Storage\Factory\AuthStorageFactory;
use Auth\Storage\Factory\IdentityManagerFactory;
use Auth\Storage\IdentityManager;
use Auth\View\Helper\UserIdentity;
use Interop\Container\ContainerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerPluginProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

class Module implements ConfigProviderInterface, ServiceProviderInterface, ViewHelperProviderInterface, ControllerPluginProviderInterface {

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
                IdentityManager::class=>IdentityManagerFactory::class,

                AuthStorage::class=>AuthStorageFactory::class,

                Acl::class=>AclFactory::class,

                AuthRepository::class=>AuthRepositoryFactory::class,

                Resources::class=>ResourcesFactory::class,

                ResourcesRepository::class=>ResourcesRepositoryFactory::class,

                ResourcesForm::class=>ResourcesFormFactory::class,

                ResourcesFilter::class=>ResourcesFilterFactory::class,

                Roles::class=>RolesFactory::class,

                RolesRepository::class=>RolesRepositoryFactory::class,

                RolesForm::class=>RolesFormFactory::class,

                RolesFilter::class=>RolesFilterFactory::class,

                Privileges::class=>PrivilegesFactory::class,

                PrivilegesRepository::class=>PrivilegesRepositoryFactory::class,

                PrivilegesForm::class=>PrivilegesFormFactory::class,

                PrivilegesFilter::class=>PrivilegesFilterFactory::class,

                Users::class=>UsersFactory::class,

                UsersRepository::class=>UsersRepositoryFactory::class,

                UsersForm::class=>UsersFormFactory::class,

                UsersFilter::class=>UsersFilterFactory::class,

                AuthForm::class=>AuthFormFactory::class,

                AuthFilter::class=>AuthFilterFactory::class,

                ProfileForm::class=>ProfileFormFactory::class,

                ProfileFilter::class=>ProfileFilterFactory::class,

                UpdatePasswordForm::class=>UpdatePasswordFormFactory::class,

                UpdatePasswordFilter::class=>UpdatePasswordFilterFactory::class
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
            ],
            'factories'=>[
                'UserIdentity'=> function(ContainerInterface $container)
                {
                    return new UserIdentity($container);
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
    public function getControllerPluginConfig()
    {
        return [
            'invokables'=>[
            ],
            'factories'=>[
                'IsAllowed' => function (ContainerInterface $container) {
                    $auth = $container->get(IdentityManager::class);
                    $acl = $container->get(Acl::class);
                    return new IsAllowed($auth, $acl);
                }
            ]
        ];
    }
}