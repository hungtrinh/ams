<?php
use Achievement\Account\Validator\UsernameUniqueFactory;
use Achievement\Student\Factory\WriteControllerFactory;
use Achievement\Student\Service\Register;

return [
    'forms' => include __DIR__ . '/form.config.php',
    'validators' => [
        'factories' => [
            'username_unique' => UsernameUniqueFactory::class,
        ],
    ],
    'log' => [
        'Log\App' => [
            'writers' => [
                [
                    'name' => 'stream',
                    'priority' => 1000,
                    'options' => [
                        'stream' => './data/logs/app.log',
                    ],
                ],
            ],
        ],
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
            'RegisterStudentService' => Register::class,
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
