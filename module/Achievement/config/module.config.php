<?php
use Achievement\Account\Validator\UsernameUniqueFactory;
use Achievement\Student\Factory\WriteControllerFactory;
use Achievement\Student\Service\StudentRegister;
use Achievement\Student\Factory\ProfileFormHydratorFactory;

return [
    'input_filters' => [
        'abstract_factories' => [
            'Zend\InputFilter\InputFilterAbstractServiceFactory'
        ],
    ],
    'input_filter_specs' => include __DIR__ . '/inputfilters.config.php',

    'forms' => include __DIR__ . '/form.config.php',

    'validators' => [
        'factories' => [
            'username_unique' => UsernameUniqueFactory::class,
        ],
    ],
    'hydrators' => [
        'factories' => [
            'Achievement\Student\Hydrator\ProfileForm' => ProfileFormHydratorFactory::class,
        ]
    ],
    'view_manager' => [
         'template_path_stack' => [
             __DIR__ . '/../view',
         ],//template_path_stack
     ],//view_manager
    'controllers' => [
        'factories' => [
            'Achievement\Controller\StudentWrite' => WriteControllerFactory::class,
        ]
     ],
    'service_manager' => [
        'invokables' => [
            'RegisterStudentService' => StudentRegister::class,
        ]
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
                                'controller' => 'Achievement\Controller\StudentWrite',
                                'action' => 'add',
                            ]//defaults
                        ], //options
                    ], //add
                ], //child_routes
            ], //route
        ], //routes
    ], //router
];
