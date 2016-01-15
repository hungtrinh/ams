<?php
namespace AchievementTest\Account\Form;

use PHPUnit_Framework_TestCase as TestCase;
use Achievement\Account\Form\AccountBasicFieldset;
use AchievementTest\Bootstrap;

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

    public function testDefaultUseAccountBasicHydrator()
    {
        Bootstrap::init();
        $services = Bootstrap::getServiceManager();
        $hydrators = $services->get('HydratorManager');

        $accountBasicFieldset = $services->get(AccountBasicFieldset::class);
        $expectedHydrator = $hydrators->get('AccountBasicHydrator');
        $hydratorUseByAccountFieldset = $accountBasicFieldset->getHydrator();
        $this->assertEquals($expectedHydrator, $hydratorUseByAccountFieldset);
    }
}
