<?php

return [
    'Achievement\InputFilter\Student' => [
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
                            ],
                        ],
                    ], //validators
                ], //username
                'password' => [
                    'name' => 'password',
                ]
            ],
        ],
    ],
];
