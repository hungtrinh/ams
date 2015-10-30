<?php

namespace AchievementTest\Student\Service;

use PHPUnit_Framework_TestCase;
use AchievementTest\Bootstrap;

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
        $this->assertInstanceOf(\Achievement\Student\Service\RegisterInterface::class, $this->registerService);
    }
}
