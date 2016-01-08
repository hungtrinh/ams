<?php

namespace Achievement\Student\Mapper;

use Achievement\Student\Model\ProfileInterface;

/**
 * Definition method to persit an profile
 * @author hungtd
 */
interface ProfilePersitInterface
{
    /**
     * Persit new profile to persitent
     * @param ProfileInterface $profile
     */
    public function addNew(ProfileInterface $profile);
}
