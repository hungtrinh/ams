<?php

namespace AchievementTest\Controller;

use PHPUnit_Framework_TestCase;
use Achievement\Student\Factory\factory;
use Achievement\Controller\StudentPersitControllerFactory;
use Achievement\Controller\StudentPersitController;
use Achievement\Student\Form\ProfileForm;
use Achievement\Student\Service\StudentRegisterInterface;

/**
 * Test factory create Achievement\Controller\StudentWriteController in right way
 */
class StudentPersitFactoryTest extends PHPUnit_Framework_TestCase
{
    /** @var \Achievement\Controller\StudentPersitControllerFactory */
    protected $factory;

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
        $services->get(StudentRegisterInterface::class)->willReturn($studentRegisterService);
        $controllers->getServiceLocator()->willReturn($services->reveal());

        $this->controllers = $controllers->reveal();
        $this->factory     = new StudentPersitControllerFactory();
    }

    public function testCallInvokeReturnStudentWriteController()
    {
        $studentController = $this->factory->__invoke($this->controllers);
        $this->assertInstanceOf(StudentPersitController::class, $studentController);
    }
}
