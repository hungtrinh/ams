<?php

namespace Achievement\Student\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use Achievement\Student\Service\StudentRegister;
use Achievement\Student\Mapper\ProfilePersitInterface;

/**
 * Create an instance \Achievement\Student\Service\StudentRegister
 *
 * @author hungtd
 */
class StudentRegisterFactory
{
    
    public function __invoke(ServiceLocatorInterface $services)
    {
        $profileMapper = $services->get(ProfilePersitInterface::class);
        return new StudentRegister($profileMapper);
    }
}
