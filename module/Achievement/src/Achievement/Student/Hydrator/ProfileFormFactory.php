<?php

namespace Achievement\Student\Hydrator;

use Zend\Stdlib\Hydrator\HydratorPluginManager;
use Zend\Stdlib\Hydrator\NamingStrategy\ArrayMapNamingStrategy;

class ProfileFormFactory
{
    public function __invoke(HydratorPluginManager $hydrators)
    {
        $namingStrategy = new ArrayMapNamingStrategy([
            'registrationCode'  => 'registration-code',
            'phoneticName'      => 'phonetic-name',
        ]);
        
        /* @var $hydrator \Zend\Stdlib\Hydrator\ClassMethods */
        $hydrator = $hydrators->get('classmethods'); 
        $hydrator->setNamingStrategy($namingStrategy);
        return $hydrator;
    }
}
