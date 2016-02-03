<?php
namespace Achievement;

return [
    Student\Form\SiblingFieldset::class => [
        'type' => 'fieldset',
        'name' => Student\Form\SiblingFieldset::NAME,
        'hydrator' => Student\Hydrator::SIBLINGS_HYDRATOR,
        'object' => Student\Model\Sibling::class,
        'elements' => [
            [
                'spec' => [
                    'type' => 'text',
                    'name' => Student\Form\SiblingFieldset::FULLNAME,
                    'options' => [
                        'label' => 'Full name',
                    ],
                ],//spec
            ],//fullname
            [
                'spec' => [
                    'type' => 'text',
                    'name' => Student\Form\SiblingFieldset::DOB,
                    'options' => [
                        'label' => 'Date of birth',
                    ],
                    'attributes' => [
                        'data-provide' => 'datepicker',
                    ],
                ],//spec
            ],//dob
            [
                'spec' => [
                    'type' => 'select',
                    'name' => Student\Form\SiblingFieldset::RELATIONSHIP,
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
                    'name' => Student\Form\SiblingFieldset::WORK,
                    'options' => [
                        'label' => 'Work',
                    ],
                ],//spec
            ],//work
        ],//elements
    ],//Achievement\Form\Sibling

    Account\Form\AccountBasicFieldset::class => [
        'type' => 'fieldset',
        'name' => 'accountbasic',
        'hydrator' => Account\Hydrator::ACCOUNT_BASIC_HYDRATOR,
        'object' => Account\Model\AccountBasicModel::class,
        'elements' => [
            [
                'spec' => [
                    'type' => 'hidden',
                    'name' => Account\Form\AccountBasicFieldset::ID,
                ],//spec
            ],//userid
            [
                'spec' => [
                    'type' => 'text',
                    'name' => Account\Form\AccountBasicFieldset::USERNAME,
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
                    'name' => Account\Form\AccountBasicFieldset::PASSWORD,
                    'options' => [
                        'label' => 'Password',
                    ],
                ],//spec
            ],//username
        ],//elements
    ],//Account\Form\AccountBasicFieldset::class

    Student\Form\ProfileFieldset::class => [
        'type' => 'fieldset',
        'name' => 'student',
        'hydrator' => Student\Hydrator::PROFILE_FORM_HYDRATOR,
        'object' => Student\Model\Profile::class,
        'elements' => [
            [
                'spec' => [
                    'type' => 'text',
                    'name' => Student\Form\ProfileFieldset::REGISTRATION_CODE,
                    'options' => [
                        'label' => 'Registration code',
                    ],
                    'attributes' => [
                        'maxlength' => 7,
                    ],
                ],//spec
            ],//Student\Form\ProfileFieldset::REGISTRATION_CODE
            [
                'spec' => [
                    'type' => 'text',
                    'name' => Student\Form\ProfileFieldset::FULLNAME,
                    'options' => [
                        'label' => 'Full name',
                    ],
                ],//spec
            ],//Student\Form\ProfileFieldset::FULLNAME
            [
                'spec' => [
                    'type' => 'text',
                    'name' => Student\Form\ProfileFieldset::PHONETIC_NAME,
                    'options' => [
                        'label' => 'Phonetic name',
                    ],
                ],//spec
            ],//Student\Form\ProfileFieldset::PHONETIC_NAME
            [
                'spec' => [
                    'type' => 'text',
                    'name' => Student\Form\ProfileFieldset::DATE_OF_BIRTH,
                    'options' => [
                        'label' => 'Date of birth',
                    ],
                    'attributes' => [
                        'data-provide' => 'datepicker',
                        'data-toggle' => 'popover',
                        'data-content' => "Example: 1999-12-28",
                    ],
                ],//spec
            ],//Student\Form\ProfileFieldset::DATE_OF_BIRTH
            [
                'spec' => [
                    'type' => 'select',
                    'name' => Student\Form\ProfileFieldset::GENDER,
                    'options' => [
                        'label' => 'Gender',
                        'value_options' => [
                            'male' => 'Male',
                            'female' => 'Female',
                        ],
                    ],
                ],//spec
            ],//Student\Form\ProfileFieldset::GENDER
            [
                'spec' => [
                    'type' => 'select',
                    'name' => Student\Form\ProfileFieldset::GRADE,
                    'options' => [
                        'label' => 'School year',
                        'value_options' => [
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                        ],
                    ],
                ],//spec
            ],//Student\Form\ProfileFieldset::GRADE
            [
                'spec' => [
                    'type' => Account\Form\AccountBasicFieldset::class,
                    'name' => Student\Form\ProfileFieldset::ACCOUNT,
                    'options' => [
                        'label'                => 'Account',
                        'use_as_base_fieldset' => true,
                    ],
                ],//spec
            ],//Student\Form\ProfileFieldset::ACCOUNT
            [
                'spec' => [
                    'type' => 'collection',
                    'name' => Student\Form\ProfileFieldset::SIBLINGS,
                    'options' => [
                        'label' => 'Siblings',
                        'count' => 1,
                        'should_create_template' => true,
                        'allow_add' => true,
                        'target_element' => [
                            'type' => Student\Form\SiblingFieldset::class,
                        ],
                    ],
                ],//spec
            ],//Student\Form\ProfileFieldset::SIBLINGS
            [
                'spec' => [
                    'type' => 'collection',
                    'name' => Student\Form\ProfileFieldset::COURSES,
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
                                        'type' => Student\Form\Element::COURSE_SELECT,
                                        'name' => 'code',
                                        'options' => [
                                            'label' => 'Course code',
                                        ],
                                    ],//spec
                                ],//Student\Form\Element::COURSE_SELECT
                            ],//elements
                        ],//target_element
                    ],//options
                ],//spec
            ],//Student\Form\ProfileFieldset::COURSES
        ],//elements
    ],//Student\Form\ProfileFieldset::class

    Student\Form\ProfileForm::class => [
        'type' => 'form',
        'name' => 'add-student',
        'input_filter' => Student\InputFilter::STUDENT_FORM_INPUT_FILTER,
        'elements' => [
            [
                'spec' => [
                    'type' => Student\Form\ProfileFieldset::class,
                    'name' => Student\Form\ProfileForm::STUDENT,
                    'options' => [
                        'use_as_base_fieldset' => true,
                    ],
                ],
            ],//Student\Form\ProfileForm::STUDENT
            [
                'spec' => [
                    'type' => 'csrf',
                    'name' => Student\Form\ProfileForm::SECURITY,
                ],
            ],//Student\Form\ProfileForm::SECURITY
            [
                'spec' => [
                    'type' => 'submit',
                    'name' => Student\Form\ProfileForm::SUBMIT,
                    'options' => [
                        'exclude' => true,
                    ],
                    'attributes' => [
                        'value' => 'Add new',
                    ],
                ],//spec
            ],//add new button
        ],//elements
    ],//Student\Form\ProfileForm::class
];
