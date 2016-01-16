<?php

namespace Achievement;

return [
    'input_filters' => [
        'abstract_factories' => [
            'Zend\InputFilter\InputFilterAbstractServiceFactory'
        ],
    ],
    'input_filter_specs' => include __DIR__ . '/inputfilters.config.php',
    'hydrators' => [
        'aliases' => [
            'AccountBasicHydrator' => 'classmethods',
        ],//invokables
        'factories' => [
            Student\Hydrator::PROFILE_FORM_HYDRATOR => Student\Form\ProfileFormHydratorFactory::class,
        ],//factories
    ],//hydrators
    'form_elements' => [
        'factories' => [
            Student\Form\Element::COURSE_SELECT => Student\Form\Element\CourseSelectFactory::class,
        ],//factories
    ],//form_elements
    'forms' => include __DIR__ . '/form.config.php',
    'service_manager' => [
        'invokables' => [
            Student\Mapper\ProfilePersitInterface::class => Student\Mapper\ProfilePersitTableGateway::class,
        ],//invokables
        'factories' => [
            Student\Service\StudentRegisterInterface::class => Student\Service\StudentRegisterFactory::class,
        ],//factories
        'aliases' => [
            'RegisterStudentService' => Student\Service\StudentRegisterInterface::class,
        ],//aliases
    ],//service_manager
    'view_manager' => [
         'template_path_stack' => [
             __DIR__ . '/../view',
         ],//template_path_stack
     ],//view_manager
    'controllers' => [
        'factories' => [
            'Achievement\Controller\StudentPersit' => Controller\StudentPersitControllerFactory::class,
        ],//factories
     ],//controllers
    'router' => [
        'routes' => [
            'student' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/student',
                    'defaults' => [
                        'controller' => 'Achievement\Controller\StudentPersit',
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
    ],//router
];
