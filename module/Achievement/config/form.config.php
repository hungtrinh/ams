<?php
use Achievement\Student\Form\ProfileForm;
use Achievement\Student\Form\ProfileFieldset;
use Achievement\Student\Model\Profile as ProfileModel;

return [
    'Achievement\Form\Sibling' => [
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
    ], //Achievement\Form\Sibling

    'Achievement\Form\AccountBasicFieldset' => [
        'type' => 'fieldset',
        'name' => 'accountbasic',
        'elements' => [
            [
                'spec' => [
                    'type' => 'hidden',
                    'name' => 'id',
                ],
            ], //userid
            [
                'spec' => [
                    'type' => 'text',
                    'name' => 'username',
                    'options' => [
                        'label' => 'Username',
                    ],
                    'attributes' => [
                        'maxlength' => 7,
                    ],
                ],
            ], //username
            [
                'spec' => [
                    'type' => 'password',
                    'name' => 'password',
                    'options' => [
                        'label' => 'Password',
                    ],
                ],
            ], //username
        ], // elements
    ], //Achievement\Form\AccountBasicFieldset

    ProfileFieldset::class => [
        'type' => 'fieldset',
        'name' => 'student',
        'hydrator' => 'Achievement\Student\Hydrator\ProfileForm',
        'object' => ProfileModel::class,
        'elements' => [
            [
                'spec' => [
                    'type' => 'text',
                    'name' => ProfileFieldset::REGISTRATION_CODE,
                    'options' => [
                        'label' => 'Registration code',
                    ],
                    'attributes' => [
                        'maxlength' => 7,
                    ],
                ],
            ], //registration-code
            [
                'spec' => [
                    'type' => 'text',
                    'name' => ProfileFieldset::FULLNAME,
                    'options' => [
                        'label' => 'Full name',
                    ],
                ],
            ], //fullname
            [
                'spec' => [
                    'type' => 'text',
                    'name' => ProfileFieldset::PHONETIC_NAME,
                    'options' => [
                        'label' => 'Phonetic name',
                    ],
                ],
            ], //phonetic-name
            [
                'spec' => [
                    'type' => 'text',
                    'name' => ProfileFieldset::DATE_OF_BIRTH,
                    'options' => [
                        'label' => 'Date of birth',
                    ],
                ],
            ], //dob
            [
                'spec' => [
                    'type' => 'select',
                    'name' => ProfileFieldset::GENDER,
                    'options' => [
                        'label' => 'Gender',
                        'value_options' => [
                            'male' => 'Male',
                            'female' => 'Female',
                        ],
                    ],
                ],
            ], //gender
            [
                'spec' => [
                    'type' => 'select',
                    'name' => ProfileFieldset::GRADE,
                    'options' => [
                        'label' => 'School year',
                        'value_options' => [
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                        ],
                    ],
                ],
            ], //grade
            [
                'spec' => [
                    'type' => 'collection',
                    'name' => ProfileFieldset::SIBLINGS,
                    'options' => [
                        'label' => 'Siblings',
                        'count' => 1,
                        'should_create_template' => false,
                        'allow_add' => true,
                        'target_element' => [
                            'type' => 'Achievement\Form\Sibling',
                        ],
                    ],
                ],
            ], //siblings
            [
                'spec' => [
                    'type' => 'Achievement\Form\AccountBasicFieldset',
                    'name' => ProfileFieldset::ACCOUNT,
                    'options' => [
                        'label'                => 'Account',
                        'use_as_base_fieldset' => true,
                    ],
                ],
            ], //account
            [
                'spec' => [
                    'type' => 'collection',
                    'name' => ProfileFieldset::COURSES,
                    'options' => [
                        'label' => 'Courses',
                        'count' => 5,
                        'should_create_template' => false,
                        'allow_add' => false,
                        'target_element' => [
                            'type' => 'fieldset',
                            'elements' => [
                                [
                                    'spec' => [
                                        'type' => 'select',
                                        'name' => 'code',
                                        'options' => [
                                            'label' => 'Course code',
                                            'value_options' => [
                                                '1' => '1',
                                                '2' => '2',
                                                '3' => '3',
                                            ],
                                        ],
                                    ],
                                ], //code
                            ],//elements
                        ],
                    ],
                ],
            ], //course
        ], //elements
    ], //ProfileFieldset::class

    ProfileForm::class => [
        'type' => 'form',
        'name' => 'add-student',
        'input_filter' => 'Achievement\InputFilter\Student',
        'elements' => [
            [
                'spec' => [
                    'type' => ProfileFieldset::class,
                    'name' => ProfileForm::STUDENT,
                    'options' => [
                        'use_as_base_fieldset' => true,
                    ],
                ],
            ], //student fieldset
            [
                'spec' => [
                    'type' => 'csrf',
                    'name' => ProfileForm::SECURITY,
                ],
            ], //security
            [
                'spec' => [
                    'type' => 'submit',
                    'name' => ProfileForm::SUBMIT,
                    'options' => [
                        'exclude' => true,
                    ],
                    'attributes' => [
                        'value' => 'Add new',
                    ],
                ],
            ], // add new button
        ], //elements
    ], //ProfileForm::class
];
