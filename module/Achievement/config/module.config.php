<?php
return [
    'forms' => include __DIR__ . '/form.config.php',
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
            'Achievement\Controller\StudentWrite' => 'Achievement\Student\Factory\WriteControllerFactory',
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
                    'save' => [
                        'type' => 'literal',
                        'options' => [
                            'route' => '/save',
                            'defaults' => [
                                'controller' => 'Achievement\Controller\StudentWrite',
                                'action' => 'save',
                            ]//defaults
                        ], //options
                    ], //save
                ], //child_routes
            ], //route
        ], //routes
    ], //router
];
