<?php
namespace Make;
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 31/07/2016
 * Time: 10:32
 */

use Make\Controller\Factory\MakeControllerFactory;
use Make\Controller\Factory\MakesControllerFactory;
use Make\Controller\MakesController;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
           'make' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/make[/:action][/:id]',
                    'defaults' => [
                        'controller' => Controller\MakeController::class,
                        'action'     => 'index',
                        'id'     => '0',
                    ],

                ],
                'may_terminate' => true,
                'child_routes' => [
                    'list' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '[/:page]',
                            'defaults' => [
                                'controller' => Controller\MakeController::class,
                                'page'     => '1',
                            ],
                        ],
                    ],
                ]
            ],
            'makes' => [

                'type'    => Segment::class,

                'options' => [

                    'route'    => '/makes[/:action][/:id]',

                    'defaults' => [

                        'controller' => Controller\MakesController::class,

                        'action'     => 'index',

                        'id'     => '0',

                    ],

                ],

            ]

        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\MakeController::class => MakeControllerFactory::class,
            MakesController::class=>MakesControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];