<?php

return [
    'Achievement\InputFilter\Student' => [
        'student' => [
            'type' => 'input_filter',
            'registration-code' => [
                'name'       => 'registration-code',
                'required'   => true,
            ],
            'phonetic-name' => [
                'name'       => 'phonetic-name',
                'required'   => true,
            ],
            'fullname' => [
                'name'       => 'fullname',
                'required'   => true,
            ],
            'dob' => [
                'name'       => 'dob',
                'required'   => true,
            ],
            'account' => [
                'type' => 'input_filter',
                'username' => [
                    'name' => 'username',
                    'required' => true,
                    'validators' => [
                        [
                            'name' => 'regex',
                            'options' => [
                                'pattern' => '/[0-9]{7}/',
                            ],
                        ],
                    ], //validators
                ], //username
                'password' => [
                    'name' => 'password',
                    'required' => true,
                ]
            ],
        ],
    ],
];
