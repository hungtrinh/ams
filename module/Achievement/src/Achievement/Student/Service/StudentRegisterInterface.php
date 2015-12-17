<?php

namespace Achievement\Student\Service;

/**
 * Register an student
 */
interface StudentRegisterInterface
{

    /**
     * Registe an student
     * @param mixed $student
     * @return void
     */
    public function register($student);
}
