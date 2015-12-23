<?php

namespace Achievement\Student\Hydrator;

use Zend\Stdlib\Hydrator\HydratorPluginManager;
use Zend\Stdlib\Hydrator\NamingStrategy\ArrayMapNamingStrategy;

class ProfileFormFactory
{
    public function __invoke(HydratorPluginManager $locator)
    {
        $namingStrategy = new ArrayMapNamingStrategy([
            'registrationCode'  => 'registration-code',
            'phoneticName'      => 'phonetic-name',
        ]);
        $hydrator = $locator->get('classmethods');
        $hydrator->setNamingStrategy($namingStrategy);
        return $hydrator;
    }
}
