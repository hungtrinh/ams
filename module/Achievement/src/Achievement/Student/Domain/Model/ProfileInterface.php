<?php

namespace Achievement\Student\Domain\Model;

interface ProfileInterface
{
    public function getRegistrationCode();
    public function getKatakanaName();
    public function getFullame();
    public function getDob();
    public function getGender();
    public function getGrade();
    public function getAccount();
}
