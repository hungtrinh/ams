<?php
namespace AchievementTest\Account\Form;

use PHPUnit_Framework_TestCase as TestCase;
use Achievement\Account\Form\AccountBasicFieldset;

class AccountBasicFieldsetTest extends TestCase
{
    public function testHasConstIdSupportAccessAccountIdElement()
    {
        $this->assertEquals('id', AccountBasicFieldset::ID);
    }

    public function testHasConstUsernameSupportAccessAccountUsernameElement()
    {
        $this->assertEquals('username', AccountBasicFieldset::USERNAME);
    }

    public function testHasConstPasswordSupportAccessAccountPasswordElement()
    {
        $this->assertEquals('password', AccountBasicFieldset::PASSWORD);
    }
}
