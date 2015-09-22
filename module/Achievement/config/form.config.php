<?php
return [

    'Fieldset\Sibling' => [
        'type' => 'fieldset',
        'name' => 'sibling',
        'elements' => [
            [
                'spec' => [
                    'type' => 'text',
                    'name' => 'fullname',
                    'options' => [
                        'label' => 'Full name',
                    ],
                ],
            ], //fullname
            [
                'spec' => [
                    'type' => 'text',
                    'name' => 'dob',
                    'options' => [
                        'label' => 'Date of birth',
                    ],
                ],
            ], //dob
            [
                'spec' => [
                    'type' => 'select',
                    'name' => 'relationship',
                    'options' => [
                        'label' => 'Relationship',
                        'value_options' => [
                            'sister' => 'Sister',
                            'brother' => 'Brother',
                        ],
                    ],
                ],
            ], //relationship
            [
                'spec' => [
                    'type' => 'text',
                    'name' => 'work',
                    'options' => [
                        'label' => 'Work',
                    ],
                ],
            ], //work
        ],//elements
    ], //Fieldset\Sibling

    'Fieldset\Student' => [
        'type' => 'fieldset',
        'name' => 'student',
        'elements' => [
            [
                'spec' => [
                    'type' => 'text',
                    'name' => 'registration-code',
                    'options' => [
                        'label' => 'Registration code',
                    ],
                ],
            ], //registration-code
            [
                'spec' => [
                    'type' => 'text',
                    'name' => 'fullname',
                    'options' => [
                        'label' => 'Full name',
                    ],
                ],
            ], //fullname
            [
                'spec' => [
                    'type' => 'text',
                    'name' => 'katakana-name',
                    'options' => [
                        'label' => 'Katakana name',
                    ],
                ],
            ], //katakana-name
            [
                'spec' => [
                    'type' => 'text',
                    'name' => 'dob',
                    'options' => [
                        'label' => 'Date of birth',
                    ],
                ],
            ], //dob
            [
                'spec' => [
                    'type' => 'select',
                    'name' => 'gender',
                    'options' => [
                        'label' => 'Gender',
                    ],
                ],
            ], //gender
            [
                'spec' => [
                    'type' => 'select',
                    'name' => 'school-year',
                    'options' => [
                        'label' => 'School year',
                    ],
                ],
            ], //school-year
            [
                'spec' => [
                    'type' => 'collection',
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
        'type' => 'form',
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
            ], //student
        ], //elements
    ], //Form\Student

];
