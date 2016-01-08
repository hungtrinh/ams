<?php

namespace Achievement\Student\Factory;

use Achievement\Controller\StudentWriteController;
use Zend\Mvc\Controller\ControllerManager;

/**
 * Make StudentWriteController
 */
class WriteControllerFactory
{

    public function __invoke(ControllerManager $controllers)
    {
        $services = $controllers->getServiceLocator();
        return new StudentWriteController(
            $services->get('Achievement\Form\Student'),
            $services->get('RegisterStudentService')
        );
    }
}
