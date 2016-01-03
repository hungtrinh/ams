<?php

namespace AchievementTest\Student\Factory;

use PHPUnit_Framework_TestCase;
use Achievement\Student\Factory\WriteControllerFactory;
use AchievementTest\Bootstrap;
use Achievement\Controller\StudentWriteController;

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
        $studentForm = $this->prophesize('\Zend\Form\FormInterface')->reveal();
        $studentRegisterService = $this->prophesize('Achievement\Student\Service\StudentRegisterInterface')->reveal();
        
        $services = Bootstrap::getServiceManager();
        $services->setAllowOverride(true);
        $services->setService('Achievement\Form\Student', $studentForm);
        $services->setService('Achievement\Student\Service\StudentRegister', $studentRegisterService);
        
        $this->controllerManager = $services->get('ControllerManager');
        $this->factory           = new WriteControllerFactory();
    }

    public function testCallInvokeReturnStudentWriteController()
    {
        $studentController = $this->factory->__invoke($this->controllerManager);
        $this->assertInstanceOf(StudentWriteController::class, $studentController);
    }
}
