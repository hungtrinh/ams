<?php

namespace AchievementTest\Student\Model;

use PHPUnit_Framework_TestCase as TestCase;
use Achievement\Student\Model\Profile;

class ProfileTest extends TestCase
{
    public function testSetDobThrowExceptionWhenInputTypeOtherNullOrDateTime()
    {
        $this->setExpectedException(\Achievement\Student\Model\InvalidArgumentException::class);
        $profile = new Profile();
        $profile->setDob('1985-11-01');
    }
}
