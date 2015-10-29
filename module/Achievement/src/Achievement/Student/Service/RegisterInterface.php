<?php

namespace Achievement\Student\Service;

/**
 * Register an student
 */
interface RegisterInterface
{

    /**
     * Registe an student
     * @param mixed $student
     * @return void
     */
    public function register($student);
}