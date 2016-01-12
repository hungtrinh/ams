<?php

namespace Achievement\Student\Factory;

use Achievement\Controller\StudentPersitController;
use Achievement\Student\Form\ProfileForm;
use Zend\Mvc\Controller\ControllerManager;

/**
 * Make StudentWriteController
 */
class WriteControllerFactory
{

    public function __invoke(ControllerManager $controllers)
    {
        $services = $controllers->getServiceLocator();
        return new StudentPersitController(
            $services->get(ProfileForm::class),
            $services->get('RegisterStudentService')
        );
    }
}
