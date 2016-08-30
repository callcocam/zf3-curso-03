<?php
$navigtion=include __DIR__.'/navigation.php';
return [
    'navigation' => $navigtion,
    'service_manager' => [
        'abstract_factories' => [
           // \Zend\Navigation\Service\NavigationAbstractServiceFactory::class,
        ],
        'factories' => [
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
            'special' => 'Base\Navigation\Factory\SpecialNavigationFactory',
        ],
    ],
];