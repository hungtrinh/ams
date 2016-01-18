<?php

namespace Achievement\Student\Form;

/**
 * Stub interface, support get element name of profile fieldset
 */
interface ProfileFieldset
{
    /**
     * School registration code element name
     */
    const REGISTRATION_CODE = 'registration-code';

    /**
     * Fullname element name
     */
    const FULLNAME          = 'fullname';

    /**
     * Phonetic element name
     */
    const PHONETIC_NAME     = 'phonetic-name';

    /**
     * Date of birth element name
     */
    const DATE_OF_BIRTH     = 'dob';

    /**
     * Gender element name
     */
    const GENDER            = 'gender';

    /**
     * Grade element name
     */
    const GRADE             = 'grade';

    /**
     * Sibling element name
     */
    const SIBLINGS          = 'siblings';

    /**
     * Account element name
     */
    const ACCOUNT           = 'account';

    /**
     * Course element name
     */
    const COURSES           = 'courses';
}
