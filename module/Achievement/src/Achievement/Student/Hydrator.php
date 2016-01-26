<?php

namespace Achievement\Student;

/**
 * Contain all hydrator name which has relative with student package
 */
interface Hydrator
{
    /**
     * Converter between raw profile data posted by use and profile entity
     */
    const PROFILE_FORM_HYDRATOR = 'ProfileFormHydrator';

    /**
     * Converter between profile entity and mysql(sql) persitent store data format
     */
    const PROFILE_MAPPER_HYDRATOR = 'ProfileMapperHydrator';

    /**
     * Converter between raw siblings data posted by use and Sibling entity
     */
    const SIBLINGS_HYDRATOR = 'SiblingsHydrator';
}
