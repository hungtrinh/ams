<?php

namespace Achievement;

return [
    Student\InputFilter::STUDENT_FORM_INPUT_FILTER => [
        'student' => [
            'type' => 'InputFilter',
            'registration-code' => [
                'name'       => 'registration-code',
            ],
            'phonetic-name' => [
                'name'       => 'phonetic-name',
            ],
            'fullname' => [
                'name'       => 'fullname',
            ],
            'dob' => [
                'name'       => 'dob',
            ],
            'account' => [
                'type' => 'InputFilter',
                'username' => [
                    'name' => 'username',
                    'validators' => [
                        [
                            'name' => 'regex',
                            'options' => [
                                'pattern' => '/[0-9]{7}/',
                                'messages' => [
                                    'regexNotMatch' => 'The input must contain only 7 digits'
                                ]
                            ],
                        ], // must 7 digit chars
                        [
                            'name' => 'ZF\\ContentValidation\\Validator\\DbNoRecordExists',
                            'options' => [
                                'table' => 'user',
                                'field' => 'username',
                                'adapter' => 'ams',
                            ],
                        ], // username is unique ( not duplicated)
                    ], //validators
                ], //username
                'password' => [
                    'name' => 'password',
                ]
            ], //account
        ], //student
    ], //Achievement\InputFilter\Student
];
