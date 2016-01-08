<?php

namespace AchievementTest\Student\Service;

use PHPUnit_Framework_TestCase;
use Achievement\Student\Model\Profile as StudentProfile;
use Achievement\Student\Service\StudentRegisterInterface;
use Achievement\Student\Service\StudentRegister;
use Achievement\Student\Mapper\ProfilePersitInterface;

class StudentRegisterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Achievement\Student\Service\RegisterInterface
     */
    protected $registerService;
    
    /**
     *
     * @var \Achievement\Student\Mapper\ProfileMapperInterface | \Prophecy\Prophecy\ObjectProphecy
     */
    protected $profileMapper;

    protected function setUp()
    {
        $this->profileMapper = $this->prophesize(ProfilePersitInterface::class);
        $this->registerService = new StudentRegister($this->profileMapper->reveal());
    }

    public function testIsAnInstanceOfRegisterInterface()
    {
        $this->assertInstanceOf(
            StudentRegisterInterface::class,
            $this->registerService
        );
    }

    public function testRegisterNewProfileWillDelegateCallAddNewMethodOnProfileMapperClass()
    {
        $student = new StudentProfile();
        $this->profileMapper->addNew($student)->shouldBeCalled();
        $this->registerService->register($student);
    }
}
