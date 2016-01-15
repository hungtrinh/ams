<?php
namespace AchievementTest\Account\Form;

use PHPUnit_Framework_TestCase as TestCase;
use Achievement\Account\Form\AccountBasicFieldset;
use AchievementTest\Bootstrap;
use Achievement\Account\Hydrator;

class AccountBasicFieldsetTest extends TestCase
{
    /**
     * @var \Zend\Form\FieldsetInterface
     */
    protected $accountFieldset;

    /**
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $services;

    protected function setUp()
    {
        parent::setUp();
        Bootstrap::init();
        $services = Bootstrap::getServiceManager();
        $this->services = $services;
        $this->accountFieldset = $services->get(AccountBasicFieldset::class);
    }

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
        $hydrators = $this->services->get('HydratorManager');
        $expectedHydrator = $hydrators->get(Hydrator::ACCOUNT_BASIC_HYDRATOR);
        $hydratorUseByAccountFieldset = $this->accountFieldset->getHydrator();
        $this->assertEquals($expectedHydrator, $hydratorUseByAccountFieldset);
    }

    public function testIsAnInstanceOfZendFormFieldsetInterface()
    {
        $this->assertInstanceOf(\Zend\Form\FieldsetInterface::class, $this->accountFieldset);
    }

    public function testUseAccountBasicModel()
    {
        $this->assertInstanceOf(
            \Achievement\Account\Model\AccountBasicModel::class,
            $this->accountFieldset->getObject()
        );
    }
}
