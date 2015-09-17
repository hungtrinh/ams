<?php
return [
    'controllers' => [
         'invokables' => [
             'Achievement\Controller\StudentWrite' => 'Achievement\Controller\StudentWriteController',
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
