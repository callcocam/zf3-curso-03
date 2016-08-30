<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 20/07/2016
 * Time: 23:03
 */
return [
    'zf-config'=>[
        'module'=>'module',
        'staticsalt'=>'aFGQ475SDsdfsaf2342',
        'sessao'=>'funcionarios',
        'serverHost'=>'http://rest.callcocam.com.br',
        'site_name'=>'SIGA SMART',
        'site_url'=>'http://cidadeonline.tk',
        'email_contato'=>['Caudio'=>'callcocam@gmail.com','Dani'=>'denius.net@gmail.com','Alison'=>'alissoncandiotto@gmail.com'],
        //'serverHost'=>'http://localhost.server',
        'moderarcomments'=>'1',
        'count_per_page'=>'10',
        'modules'=>['Admin'=>'Modulo Administrativo','Home'=>'Module Administrativo Dos Layouts','Auth'=>'Controle de Acesso','Make'=>'Construtor de Modulos'],
        'grupos'=>['Admin'=>'Administrativo','Home'=>'Layouts','Auth'=>'Controle de Acesso','Make'=>'Construtor de Modulos'],
        'routeAuthenticate'=>'auth',
        'routeLogout'=>['action'=>'logout-success'],
        'routeSuccess'=>['action'=>'success'],
    ]
];