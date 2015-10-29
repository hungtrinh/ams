<?php

namespace AchievementTest\Student\Factory;

use PHPUnit_Framework_TestCase;
use Achievement\Student\Factory\WriteControllerFactory;
use AchievementTest\Bootstrap;

/**
 * Test factory create Achievement\Controller\StudentWriteController in right way
 */
class WriteControllerFactoryTest extends PHPUnit_Framework_TestCase
{
    /** @var \Achievement\Student\Factory\WriteControllerFactory */
    protected $factory;

    /** @var \Zend\Mvc\Controller\ControllerManager */
    protected $controllerManager;

    protected function setUp()
    {
        parent::setUp();
        $this->controllerManager = Bootstrap::getServiceManager()->get('ControllerManager');
        $this->factory           = new WriteControllerFactory();
    }

    public function testCallInvokeReturnStudentWriteController()
    {
        $studentWriteController = $this->factory->__invoke($this->controllerManager);
        $this->assertInstanceOf(\Achievement\Controller\StudentWriteController::class, $studentWriteController);
    }
}
