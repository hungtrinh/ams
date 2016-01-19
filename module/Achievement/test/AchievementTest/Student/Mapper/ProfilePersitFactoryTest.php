<?php
namespace AchievementTest\Student\Mapper;

use PHPUnit_Framework_TestCase as TestCase;
use Achievement\Student\Mapper\ProfilePersitFactory as ProfilePersitMapperFactory;
use Achievement\Student\Mapper\ProfilePersitInterface;
use Achievement\Student\Hydrator;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Stdlib\Hydrator\HydratorPluginManager;

class ProfilePersitFactoryTest extends TestCase
{
    /**
     * @var \Achievement\Student\Mapper\ProfilePersitFactory
     */
    protected $factory;

    /**
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $services;

    protected function setUp()
    {
        parent::setUp();
        $this->factory = new ProfilePersitMapperFactory();

        $profileMapperHydrator = $this->prophesize(HydratorInterface::class)->reveal();
        $amsDatabaseAdapter = $this->prophesize(AdapterInterface::class)->reveal();

        $hydrators = $this->prophesize(HydratorPluginManager::class);
        $hydrators->get(Hydrator::PROFILE_MAPPER_HYDRATOR)->willReturn($profileMapperHydrator)->shouldBeCalled();

        $this->services = $this->prophesize(ServiceManager::class);
        $this->services->get('ams')->willReturn($amsDatabaseAdapter)->shouldBeCalled();
        $this->services->get('HydratorManager')->willReturn($hydrators->reveal())->shouldBeCalled();
    }

    public function testWhenCallInvokeThenReturnStudentMapperProfilePersitInstance()
    {
        $factory = $this->factory;
        $this->assertInstanceOf(ProfilePersitInterface::class, $factory($this->services->reveal()));
    }
}
