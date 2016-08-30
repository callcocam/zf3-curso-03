<?php

$default= [
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
                          'resource'   =>  'admin_controller_configuracaocontroller',
                          'action'     => 'index',
                          'privilege'  => 'index',
                          'icone'      => '',
                          'title'      => 'ok',
                    ],


                    [
                          'label'      => 'CLIENTES',
                          'route'      => 'clientes',
                          'controller' => 'clientes',
                          'resource'   =>  'admin_controller_clientescontroller',
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
                          'resource'   =>  'auth_controller_userscontroller',
                          'action'     => 'index',
                          'privilege'  => 'index',
                          'icone'      => '',
                          'title'      => 'ok',
                    ],


                    [
                          'label'      => 'PRIVILéGIOS',
                          'route'      => 'privileges',
                          'controller' => 'privileges',
                          'resource'   =>  'auth_controller_privilegescontroller',
                          'action'     => 'index',
                          'privilege'  => 'index',
                          'icone'      => '',
                          'title'      => 'ok',
                    ],


                    [
                          'label'      => 'RESOURCES',
                          'route'      => 'resources',
                          'controller' => 'resources',
                          'resource'   =>  'auth_controller_resourcescontroller',
                          'action'     => 'index',
                          'privilege'  => 'index',
                          'icone'      => '',
                          'title'      => 'resources',
                    ],


                    [
                          'label'      => 'ROLES',
                          'route'      => 'roles',
                          'controller' => 'roles',
                          'resource'   =>  'auth_controller_rolescontroller',
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
                          'resource'   =>  'make_controller_makescontroller',
                          'action'     => 'index',
                          'privilege'  => 'index',
                          'icone'      => '',
                          'title'      => 'modulo para construir outros modulos',
                    ],]
          ],
          ];

