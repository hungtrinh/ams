<?php

namespace AchievementTest;

use Achievement\Account\Model\AccountBasicModel;
use Achievement\Student\Form\ProfileFieldset;
use Achievement\Student\Form\ProfileForm;
use Achievement\Student\Model\Profile;
use Achievement\Student\Model\Sibling;
use DateTime;

$rawProfile = include "fullProfileFormValid.php";
$account = new AccountBasicModel;
$profile = new Profile;

$account->setPassword($rawProfile['student']['account']['password']);
$account->setUsername($rawProfile['student']['account']['username']);
$profile->setAccount($account);
$profile->setDob(DateTime::createFromFormat('Y-m-d', $rawProfile['student']['dob']));
$profile->setGender($rawProfile['student']['gender']);
$profile->setGrade($rawProfile['student']['grade']);
$profile->setFullname($rawProfile['student']['fullname']);
$profile->setPhoneticName($rawProfile['student']['phonetic-name']);
$profile->setRegistrationCode($rawProfile['student']['registration-code']);
$profile->setSiblings([
    Sibling::createFromArray($rawProfile[ProfileForm::STUDENT][ProfileFieldset::SIBLINGS][0]),
    Sibling::createFromArray($rawProfile[ProfileForm::STUDENT][ProfileFieldset::SIBLINGS][1]),
]);
return $profile;
