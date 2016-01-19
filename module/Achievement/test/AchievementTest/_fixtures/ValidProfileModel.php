<?php
$rawProfile = include "validStudentProfile.php";
$account = new \Achievement\Account\Model\AccountBasicModel;
$profile = new \Achievement\Student\Model\Profile;

$account->setPassword($rawProfile['student']['account']['password']);
$account->setUsername($rawProfile['student']['account']['username']);
$profile->setAccount($account);
$profile->setDob(DateTime::createFromFormat('Y-m-d', $rawProfile['student']['dob']));
$profile->setGender($rawProfile['student']['gender']);
$profile->setGrade($rawProfile['student']['grade']);
$profile->setFullname($rawProfile['student']['fullname']);
$profile->setPhoneticName($rawProfile['student']['phonetic-name']);
$profile->setRegistrationCode($rawProfile['student']['registration-code']);
return $profile;
