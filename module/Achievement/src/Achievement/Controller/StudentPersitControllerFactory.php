<?php

namespace Achievement\Controller;

use Achievement\Controller\StudentPersitController;
use Achievement\Student\Service\StudentRegisterInterface;
use Achievement\Student\Form\ProfileForm;
use Zend\Mvc\Controller\ControllerManager;

/**
 * Make StudentPersitController
 */
class StudentPersitControllerFactory
{
    /**
     * @param  ControllerManager $controllers
     * @return \Achievement\Controller\StudentPersitController
     */
    public function __invoke(ControllerManager $controllers)
    {
        $services = $controllers->getServiceLocator();
        return new StudentPersitController(
            $services->get(ProfileForm::class),
            $services->get(StudentRegisterInterface::class)
        );
    }
}
