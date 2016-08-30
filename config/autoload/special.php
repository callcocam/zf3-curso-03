<?php

$special= [
          [
              'label' => 'Administrativo',
              'class' => 'treeview',
              'action'     => '#',
              'icone'     => '',
              'title'   => 'Administrativo',
              'pages'   => [

                    [
                          'label'      => 'CONIGURAçõES',
                          'route'      => 'configuracao',
                          'controller' => 'configuracao',
                          'resource'   =>  'Admin\Controller\ConfiguracaoController',
                          'action'     => 'index',
                          'privilege'  => 'index',
                          'icone'      => '',
                          'title'      => 'ok',
                    ],


                    [
                          'label'      => 'CLIENTES',
                          'route'      => 'clientes',
                          'controller' => 'clientes',
                          'resource'   =>  'Admin\Controller\ClientesController',
                          'action'     => 'index',
                          'privilege'  => 'index',
                          'icone'      => '',
                          'title'      => 'cadastro de clientes do site',
                    ],]
          ],
          [
              'label' => 'Controle de Acesso',
              'class' => 'treeview',
              'action'     => '#',
              'icone'     => '',
              'title'   => 'Controle de Acesso',
              'pages'   => [

                    [
                          'label'      => 'USUARIOS',
                          'route'      => 'users',
                          'controller' => 'users',
                          'resource'   =>  'Auth\Controller\UsersController',
                          'action'     => 'index',
                          'privilege'  => 'index',
                          'icone'      => '',
                          'title'      => 'ok',
                    ],


                    [
                          'label'      => 'PRIVILéGIOS',
                          'route'      => 'privileges',
                          'controller' => 'privileges',
                          'resource'   =>  'Auth\Controller\PrivilegesController',
                          'action'     => 'index',
                          'privilege'  => 'index',
                          'icone'      => '',
                          'title'      => 'ok',
                    ],


                    [
                          'label'      => 'RESOURCES',
                          'route'      => 'resources',
                          'controller' => 'resources',
                          'resource'   =>  'Auth\Controller\ResourcesController',
                          'action'     => 'index',
                          'privilege'  => 'index',
                          'icone'      => '',
                          'title'      => 'resources',
                    ],


                    [
                          'label'      => 'ROLES',
                          'route'      => 'roles',
                          'controller' => 'roles',
                          'resource'   =>  'Auth\Controller\RolesController',
                          'action'     => 'index',
                          'privilege'  => 'index',
                          'icone'      => '',
                          'title'      => 'ok',
                    ],]
          ],
          [
              'label' => 'Construtor de Modulos',
              'class' => 'treeview',
              'action'     => '#',
              'icone'     => '',
              'title'   => 'Construtor de Modulos',
              'pages'   => [

                    [
                          'label'      => 'MAKE',
                          'route'      => 'makes',
                          'controller' => 'makes',
                          'resource'   =>  'Make\Controller\MakesController',
                          'action'     => 'index',
                          'privilege'  => 'index',
                          'icone'      => '',
                          'title'      => 'modulo para construir outros modulos',
                    ],]
          ],
          ];

