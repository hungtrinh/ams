<?php

namespace Achievement;

use Achievement\Student\Form\ProfileForm;
use Achievement\Student\Form\ProfileFieldset;
use Achievement\Student\Model\Profile as ProfileModel;
use Achievement\Student\Form\Element;
use Achievement\Student\Hydrator;
use Achievement\Account\Form\AccountBasicFieldset;

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
                ],//spec
            ],//fullname
            [
                'spec' => [
                    'type' => 'text',
                    'name' => 'dob',
                    'options' => [
                        'label' => 'Date of birth',
                    ],
                ],//spec
            ],//dob
            [
                'spec' => [
                    'type' => 'select',
                    'name' => 'relationship',
                    'options' => [
                        'label' => 'Relationship',
                        'value_options' => [
                            'sister' => 'Sister',
                            'brother' => 'Brother',
                        ],//value_options
                    ],//options
                ],//spec
            ],//relationship
            [
                'spec' => [
                    'type' => 'text',
                    'name' => 'work',
                    'options' => [
                        'label' => 'Work',
                    ],
                ],//spec
            ],//work
        ],//elements
    ],//Achievement\Form\Sibling

    AccountBasicFieldset::class => [
        'type' => 'fieldset',
        'name' => 'accountbasic',
        'elements' => [
            [
                'spec' => [
                    'type' => 'hidden',
                    'name' => AccountBasicFieldset::ID,
                ],//spec
            ],//userid
            [
                'spec' => [
                    'type' => 'text',
                    'name' => AccountBasicFieldset::USERNAME,
                    'options' => [
                        'label' => 'Username',
                    ],
                    'attributes' => [
                        'maxlength' => 7,
                    ],
                ],//spec
            ],//username
            [
                'spec' => [
                    'type' => 'password',
                    'name' => AccountBasicFieldset::PASSWORD,
                    'options' => [
                        'label' => 'Password',
                    ],
                ],//spec
            ],//username
        ],//elements
    ],//AccountBasicFieldset::class
    ProfileFieldset::class => [
        'type' => 'fieldset',
        'name' => 'student',
        'hydrator' => Hydrator::PROFILE_FORM_HYDRATOR,
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
                ],//spec
            ],//ProfileFieldset::REGISTRATION_CODE
            [
                'spec' => [
                    'type' => 'text',
                    'name' => ProfileFieldset::FULLNAME,
                    'options' => [
                        'label' => 'Full name',
                    ],
                ],//spec
            ],//ProfileFieldset::FULLNAME
            [
                'spec' => [
                    'type' => 'text',
                    'name' => ProfileFieldset::PHONETIC_NAME,
                    'options' => [
                        'label' => 'Phonetic name',
                    ],
                ],//spec
            ],//ProfileFieldset::PHONETIC_NAME
            [
                'spec' => [
                    'type' => 'text',
                    'name' => ProfileFieldset::DATE_OF_BIRTH,
                    'options' => [
                        'label' => 'Date of birth',
                    ],
                ],//spec
            ],//ProfileFieldset::DATE_OF_BIRTH
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
                ],//spec
            ],//ProfileFieldset::GENDER
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
                ],//spec
            ],//ProfileFieldset::GRADE
            [
                'spec' => [
                    'type' => AccountBasicFieldset::class,
                    'name' => ProfileFieldset::ACCOUNT,
                    'options' => [
                        'label'                => 'Account',
                        'use_as_base_fieldset' => true,
                    ],
                ],//spec
            ],//ProfileFieldset::ACCOUNT
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
                ],//spec
            ],//ProfileFieldset::SIBLINGS
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
                                        'type' => Element::COURSE_SELECT,
                                        'name' => 'code',
                                        'options' => [
                                            'label' => 'Course code',
                                        ],
                                    ],//spec
                                ],//Element::COURSE_SELECT
                            ],//elements
                        ],//target_element
                    ],//options
                ],//spec
            ],//ProfileFieldset::COURSES
        ],//elements
    ],//ProfileFieldset::class

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
            ],//ProfileForm::STUDENT
            [
                'spec' => [
                    'type' => 'csrf',
                    'name' => ProfileForm::SECURITY,
                ],
            ],//ProfileForm::SECURITY
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
                ],//spec
            ],//add new button
        ],//elements
    ],//ProfileForm::class
];
