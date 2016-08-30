<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Auth;

use Auth\Controller\Factory\AuthControllerFactory;
use Auth\Controller\Factory\PrivilegesControllerFactory;
use Auth\Controller\Factory\ProfileControllerFactory;
use Auth\Controller\Factory\ResourcesControllerFactory;
use Auth\Controller\Factory\RolesControllerFactory;
use Auth\Controller\Factory\UpdatePasswordControllerFactory;
use Auth\Controller\Factory\UsersControllerFactory;
use Auth\Controller\PrivilegesController;
use Auth\Controller\RolesController;
use Auth\Controller\UsersController;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;


return [
    'router' => [
        'routes' => [
            'auth' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/auth[/:action]',
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action'     => 'login',
                    ],
                ],
            ],
            'update-profile' => [

                'type'    => Literal::class,

                'options' => [

                    'route'    => '/update-profile',

                    'defaults' => [

                        'controller' => Controller\ProfileController::class,

                        'action'     => 'update-profile'

                    ],

                ],

            ],
            'update-password' => [

                'type'    => Literal::class,

                'options' => [

                    'route'    => '/update-password',

                    'defaults' => [

                        'controller' => Controller\UpdatePasswordController::class,

                        'action'     => 'update-password'

                    ],

                ],

            ],
            'resources' => [

                'type'    => Segment::class,

                'options' => [

                    'route'    => '/resources[/:action]',

                    'defaults' => [

                        'controller' => Controller\ResourcesController::class,

                        'action'     => 'index',

                    ],

                ],

            ],
            'privileges' => [

                'type'    => Segment::class,

                'options' => [

                    'route'    => '/privileges[/:action][/:id]',

                    'defaults' => [

                        'controller' => Controller\PrivilegesController::class,

                        'action'     => 'index',

                        'id'     => '0',

                    ],

                ],

            ],
            'users' => [

                'type'    => Segment::class,

                'options' => [

                    'route'    => '/users[/:action][/:id]',

                    'defaults' => [

                        'controller' => Controller\UsersController::class,

                        'action'     => 'index',

                        'id'     => '0',

                    ],

                ],

            ],
            'roles' => [

                'type'    => Segment::class,

                'options' => [

                    'route'    => '/roles[/:action][/:id]',

                    'defaults' => [

                        'controller' => Controller\RolesController::class,

                        'action'     => 'index',

                        'id'     => '0',

                    ],

                ],

            ],
            'resources' => [

                'type'    => Segment::class,

                'options' => [

                    'route'    => '/resources[/:action][/:id]',

                    'defaults' => [

                        'controller' => Controller\ResourcesController::class,

                        'action'     => 'index',

                        'id'     => '0',

                    ],

                ],

            ]

        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\AuthController::class => AuthControllerFactory::class,
            Controller\ProfileController::class => ProfileControllerFactory::class,
            Controller\UpdatePasswordController::class => UpdatePasswordControllerFactory::class,
            Controller\ResourcesController::class => ResourcesControllerFactory::class,
            PrivilegesController::class=>PrivilegesControllerFactory::class,
            RolesController::class=>RolesControllerFactory::class,
            UsersController::class=>UsersControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
