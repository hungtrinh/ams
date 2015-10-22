<?php

namespace Achievement\Student\Factory;

use Achievement\Controller\StudentWriteController;
use Zend\Mvc\Controller\ControllerManager;

/**
 * Make StudentWriteController
 */
class WriteControllerFactory
{
    public function __invoke(ControllerManager $controllerManager)
    {
        $locator = $controllerManager->getServiceLocator();
        return new StudentWriteController($locator->get('Form\Student'));
    }
}
