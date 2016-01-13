<?php

namespace Achievement\Student\Mapper;

use Achievement\Student\Model\ProfileInterface;

/**
 * Transformer student profile between database and application model
 * by using mysql table gateway adapter
 * @author hungtd
 */
class ProfilePersitTableGateway implements ProfilePersitInterface
{
    public function addNew(ProfileInterface $profile)
    {
        return $profile;
    }
}
