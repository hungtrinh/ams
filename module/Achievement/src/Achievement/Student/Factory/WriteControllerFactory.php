<?php

namespace Achievement\Student\Factory;

use Achievement\Controller\StudentWriteController;
use Zend\Mvc\Controller\ControllerManager;

/**
 * Make StudentWriteController
 */
class WriteControllerFactory
{
    function __invoke(ControllerManager $controllerManager)
    {
        $sm = $controllerManager->getServiceLocator();
        return new StudentWriteController($sm->get('Form\Student'));
    }
}
