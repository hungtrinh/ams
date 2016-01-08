<?php

namespace Achievement\Student\Service;

use Achievement\Student\Mapper\ProfilePersitInterface;

/**
 * {@inheritdoc}
 *
 * @author hungtd
 */
class StudentRegister implements StudentRegisterInterface
{
    /**
     * @var \Achievement\Student\Mapper\ProfilePersitInterface
     */
    protected $profileMapper;
    
    /**
     * @param ProfilePersitInterface $profileMapper
     */
    public function __construct(ProfilePersitInterface $profileMapper)
    {
        $this->profileMapper = $profileMapper;
    }
    
    /**
     * Register an student profile
     * @param type $student
     */
    public function register($student)
    {
        $this->profileMapper->addNew($student);
    }
}
