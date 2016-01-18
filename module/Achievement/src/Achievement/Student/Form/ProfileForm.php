<?php

namespace Achievement\Student\Form;

/**
 * Stub interface, support get element by element name of profile form
 * const is element name
 */
interface ProfileForm
{
    /**
     * Student element name
     */
    const STUDENT  = 'student';

    /**
     * security (csrf) element name
     */
    const SECURITY = 'security';

    /**
     * submit element name
     */
    const SUBMIT   = 'add';
}
