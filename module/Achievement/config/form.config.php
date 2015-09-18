<?php
return [
    'Fieldset\Sibling' => [
        'type' => 'Zend\Form\Fieldset',
        'name' => 'sibling',
        'elements' => [
            [
                'spec' => [
                    'type' => 'Text',
                    'name' => 'fullname',
                    'options' => [
                        'label' => 'Full name',
                    ],
                ],
            ],
            [
                'spec' => [
                    'type' => 'Text',
                    'name' => 'dob',
                    'options' => [
                        'label' => 'Date of birth',
                    ],
                ],
            ],
            [
                'spec' => [
                    'type' => 'Select',
                    'name' => 'relationship',
                    'options' => [
                        'label' => 'Relationship',
                    ],
                ],
            ],
            [
                'spec' => [
                    'type' => 'Text',
                    'name' => 'work',
                    'options' => [
                        'label' => 'Work',
                    ],
                ],
            ],
        ],//elements
    ], //Fieldset\Sibling

    'Fieldset\Student' => [
        'type' => 'Zend\Form\Fieldset',
        'name' => 'student',
        'elements' => [
            [
                'spec' => [
                    'type' => 'Text',
                    'name' => 'registration-code',
                    'options' => [
                        'label' => 'Registration code',
                    ],
                ],
            ], //registration-code
            [
                'spec' => [
                    'type' => 'Text',
                    'name' => 'fullname',
                    'options' => [
                        'label' => 'Full name',
                    ],
                ],
            ], //fullname
            [
                'spec' => [
                    'type' => 'Text',
                    'name' => 'katakana-name',
                    'options' => [
                        'label' => 'Katakana name',
                    ],
                ],
            ], //katakana-name
            [
                'spec' => [
                    'type' => 'Text',
                    'name' => 'dob',
                    'options' => [
                        'label' => 'Date of birth',
                    ],
                ],
            ], //dob
            [
                'spec' => [
                    'type' => 'Select',
                    'name' => 'gender',
                    'options' => [
                        'label' => 'Gender',
                    ],
                ],
            ], //gender
            [
                'spec' => [
                    'type' => 'Select',
                    'name' => 'school-year',
                    'options' => [
                        'label' => 'School year',
                    ],
                ],
            ], //school-year
            [
                'spec' => [
                    'type' => 'Collection',
                    'name' => 'siblings',
                    'options' => [
                        'label' => 'Siblings',
                        'count' => 1,
                        'should_create_template' => false,
                        'use_as_base_fieldset' => false,
                        'allow_add' => true,
                        'target_element' => [
                            'type' => 'Fieldset\Sibling',
                        ],
                    ],
                ],
            ], //siblings
        ], //elements
    ], //Fieldset\Student

    'Form\Student' => [
        'type' => 'Zend\Form\Form',
        'name' => 'add-student',
        'elements' => [
            [
                'spec' => [
                    'type' => 'Fieldset\Student',
                    'name' => 'student',
                    'options' => [
                        'use_as_base_fieldset' => true,
                    ],
                ],
            ],
        ],
    ], //Form\Student
];
