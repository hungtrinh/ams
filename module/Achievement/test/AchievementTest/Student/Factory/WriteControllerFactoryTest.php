<?php

namespace AchievementTest\Student\Factory;

use PHPUnit_Framework_TestCase;
use Achievement\Student\Factory\WriteControllerFactory;
use Achievement\Controller\StudentPersitController;
use Achievement\Student\Form\ProfileForm;

/**
 * Test factory create Achievement\Controller\StudentWriteController in right way
 */
class WriteControllerFactoryTest extends PHPUnit_Framework_TestCase
{
    /** @var \Achievement\Student\Factory\WriteControllerFactory */
    protected $writeControllerFactory;

    /** @var \Zend\Mvc\Controller\ControllerManager */
    protected $controllers;

    protected function setUp()
    {
        parent::setUp();

        $studentRegisterService = $this->prophesize('Achievement\Student\Service\StudentRegisterInterface')->reveal();
        $studentForm            = $this->prophesize('Zend\Form\FormInterface')->reveal();

        $services               = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');
        $controllers            = $this->prophesize('Zend\Mvc\Controller\ControllerManager');

        $services->get(ProfileForm::class)->willReturn($studentForm);
        $services->get('RegisterStudentService')->willReturn($studentRegisterService);
        $controllers->getServiceLocator()->willReturn($services->reveal());

        $this->controllers = $controllers->reveal();
        $this->writeControllerFactory           = new WriteControllerFactory();
    }

    public function testCallInvokeReturnStudentWriteController()
    {
        $studentController = $this->writeControllerFactory->__invoke($this->controllers);
        $this->assertInstanceOf(StudentPersitController::class, $studentController);
    }
}
