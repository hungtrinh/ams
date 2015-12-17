<?php

namespace AchievementTest\Student\Service;

use PHPUnit_Framework_TestCase;
use AchievementTest\Bootstrap;
use Achievement\Student\Model\Profile as StudentProfile;
use Achievement\Student\Service\StudentRegisterInterface;

class RegisterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Achievement\Student\Service\RegisterInterface
     */
    protected $registerService;

    protected function setUp()
    {
        $this->registerService = Bootstrap::getServiceManager()->get('RegisterStudentService');
    }

    public function testIsAnInstanceOfRegisterInterface()
    {
        $this->assertInstanceOf(
            StudentRegisterInterface::class,
            $this->registerService
        );
    }

    public function testRegisterWillReturnNull()
    {
        $student = new StudentProfile();
        $result = $this->registerService->register($student);
        $this->assertNull($result);
    }
}
