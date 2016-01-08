<?php

namespace AchievementTestTest\Student\Service;

use Achievement\Student\Service\StudentRegisterFactory;
use Achievement\Student\Service\StudentRegister;
use Achievement\Student\Mapper\ProfilePersitInterface;
use Zend\ServiceManager\ServiceManager;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * @author hungtd
 */
class StudentRegisterFactoryTest extends TestCase
{
    /**
     *
     * @var \Achievement\Student\Service\StudentRegisterFactory
     */
    protected $studentRegisterFactory;
    
    /**
     * @var \Zend\ServiceManager\ServiceManager | \Prophecy\Prophecy\ObjectProphecy
     */
    protected $services;
    
    protected function setUp()
    {
        parent::setUp();
        
        $profileMapper = $this->prophesize(ProfilePersitInterface::class)->reveal();
        $services = $this->prophesize(ServiceManager::class);
        $services->get(ProfilePersitInterface::class)->willReturn($profileMapper);
        
        $this->services = $services->reveal();
        
        $this->studentRegisterFactory = new StudentRegisterFactory();
    }
    
    public function testWhenCallInvokeWillReturnAnIntanceOfStudentRegisterService()
    {
        $actualService = $this->studentRegisterFactory->__invoke($this->services);
        $this->assertInstanceOf(StudentRegister::class, $actualService);
        
        $studentRegisterFactory = $this->studentRegisterFactory;
        $this->assertInstanceOf(StudentRegister::class, $studentRegisterFactory($this->services));
    }
}
