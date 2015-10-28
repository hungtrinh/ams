<?php

namespace AchievementTest\Account\Validator;

use PHPUnit_Framework_TestCase;
use AchievementTest\Bootstrap;
use Zend\Validator\Db\NoRecordExists;

/**
 * @groups intergration
 */
class UsernameUniqueFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Zend\Validator\Db\NoRecordExists
     */
    protected $usernameUnique;

    protected function setUp()
    {
        parent::setUp();
        $locator              = Bootstrap::getServiceManager()->get('ValidatorManager');
        $this->usernameUnique = $locator->get('username_unique');
    }

    public function testIsInstanceOfZendValidatorDbNoRecordExists()
    {
        $this->assertInstanceOf(NoRecordExists::class, $this->usernameUnique);
    }

    public function testSetupValidatorWithExpcectedConfig()
    {
        $this->assertEquals('user', $this->usernameUnique->getTable());
        $this->assertEquals('username', $this->usernameUnique->getField());
    }
}
