<?php

namespace AchievementTest;

use Achievement\Student\Form\ProfileForm;
use Achievement\Student\Form\ProfileFieldset;
use Achievement\Student\Form\SiblingFieldset;
use Achievement\Account\Form\AccountBasicFieldset;

return [
    ProfileForm::STUDENT => [
        ProfileFieldset::REGISTRATION_CODE  => '1234567',
        ProfileFieldset::PHONETIC_NAME  => 'Yoshikuni',
        ProfileFieldset::FULLNAME  => '吉国',
        ProfileFieldset::DATE_OF_BIRTH => '1985-01-18',
        ProfileFieldset::GENDER => 'male',
        ProfileFieldset::GRADE => 1,

        ProfileFieldset::ACCOUNT => [
            AccountBasicFieldset::ID => 1,
            AccountBasicFieldset::USERNAME => '1234567',
            AccountBasicFieldset::PASSWORD => '1234',
        ],

        ProfileFieldset::SIBLINGS => [
            [
                SiblingFieldset::FULLNAME => 'binh',
                SiblingFieldset::DOB => '1982-07-15',
                SiblingFieldset::WORK => 'programmer',
                SiblingFieldset::RELATIONSHIP => 'brother'
            ],
            [
                SiblingFieldset::FULLNAME => 'quynh',
                SiblingFieldset::DOB => '1979-12-15',
                SiblingFieldset::WORK => 'officer',
                SiblingFieldset::RELATIONSHIP => 'sister'
            ],
        ],
    ],
];
