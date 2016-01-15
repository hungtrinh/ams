<?php

use Achievement\Controller\StudentPersitControllerFactory;
use Achievement\Student\Service\StudentRegisterInterface;
use Achievement\Student\Service\StudentRegisterFactory;
use Achievement\Student\Mapper\ProfilePersitInterface;
use Achievement\Student\Mapper\ProfilePersitTableGateway;
use Achievement\Student\Hydrator\ProfileFormFactory;
use Achievement\Student\Hydrator\ProfileFormHydratorFactory;
use Achievement\Student\Form\Element\CourseSelectFactory;
use Achievement\Student\Form\Element;
use Achievement\Student\Hydrator;

return [
    'input_filters' => [
        'abstract_factories' => [
            'Zend\InputFilter\InputFilterAbstractServiceFactory'
        ],
    ],
    'input_filter_specs' => include __DIR__ . '/inputfilters.config.php',
    'hydrators' => [
        'factories' => [
            Hydrator::PROFILE_FORM_HYDRATOR => ProfileFormHydratorFactory::class,
        ],//factories
    ],//hydrators
    'form_elements' => [
        'factories' => [
            Element::COURSE_SELECT => CourseSelectFactory::class,
        ],//factories
    ],//form_elements
    'forms' => include __DIR__ . '/form.config.php',
    'view_manager' => [
         'template_path_stack' => [
             __DIR__ . '/../view',
         ],//template_path_stack
     ],//view_manager
    'controllers' => [
        'factories' => [
            'Achievement\Controller\StudentPersit' => StudentPersitControllerFactory::class,
        ],//factories
     ],//controllers
    'service_manager' => [
        'invokables' => [
            ProfilePersitInterface::class => ProfilePersitTableGateway::class,
        ],//invokables
        'factories' => [
            StudentRegisterInterface::class => StudentRegisterFactory::class,
        ],//factories
        'aliases' => [
            'RegisterStudentService' => StudentRegisterInterface::class,
        ],//aliases
    ],//service_manager
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
    ],//router
];
