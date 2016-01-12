<?php

use Achievement\Controller\StudentPersitControllerFactory;
use Achievement\Student\Service\StudentRegisterInterface;
use Achievement\Student\Service\StudentRegisterFactory;
use Achievement\Student\Mapper\ProfilePersitInterface;
use Achievement\Student\Mapper\ProfilePersitTableGateway;
use Achievement\Student\Hydrator\ProfileFormFactory;


return [
    'input_filters' => [
        'abstract_factories' => [
            'Zend\InputFilter\InputFilterAbstractServiceFactory'
        ],
    ],
    
    //required input_filters Zend\InputFilter\InputFilterAbstractServiceFactory config
    'input_filter_specs' => include __DIR__ . '/inputfilters.config.php',

    'forms' => include __DIR__ . '/form.config.php',

    'validators' => [
        'factories' => [
            
        ],
    ],
    'hydrators' => [
        'factories' => [
            'Achievement\Student\Hydrator\ProfileForm' => ProfileFormFactory::class,
        ]
    ],
    'view_manager' => [
         'template_path_stack' => [
             __DIR__ . '/../view',
         ],//template_path_stack
     ],//view_manager
    'controllers' => [
        'factories' => [
            'Achievement\Controller\StudentPersit' => StudentPersitControllerFactory::class,
        ]
     ],
    'service_manager' => [
        'invokables' => [
            ProfilePersitInterface::class => ProfilePersitTableGateway::class,
        ],
        'factories' => [
            StudentRegisterInterface::class => StudentRegisterFactory::class,
        ],
        'aliases' => [
            'RegisterStudentService' => StudentRegisterInterface::class,
        ],
    ],
    'router' => [
        'routes' => [
            'student' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/student',
                    'defaults' => [
                        'controller' => 'Achievement\Controller\StudentWrite',
                        'action' => 'index',
                    ], //defaults
                ], //options
                'may_terminate' => true,
                'child_routes'  => [
                    'add' => [
                        'type' => 'literal',
                        'options' => [
                            'route' => '/add',
                            'defaults' => [
                                'controller' => 'Achievement\Controller\StudentPersit',
                                'action' => 'add',
                            ]//defaults
                        ], //options
                    ], //add
                ], //child_routes
            ], //route
        ], //routes
    ], //router
];
