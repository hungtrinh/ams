<?php
return [
    'forms' => include __DIR__ . '/form.config.php',
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
                    // 'defaults' => [
                    //     'controller' => 'Achievement\Controller\List',
                    //     'action' => 'index',
                    // ], //defaults
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
