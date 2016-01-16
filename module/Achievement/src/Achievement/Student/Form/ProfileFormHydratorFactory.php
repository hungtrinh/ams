<?php

namespace Achievement\Student\Form;

use Zend\Stdlib\Hydrator\HydratorPluginManager;
use Zend\Stdlib\Hydrator\NamingStrategy\ArrayMapNamingStrategy;
use Zend\Stdlib\Hydrator\Strategy\DateTimeFormatterStrategy;

class ProfileFormHydratorFactory
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
        $hydrator->addStrategy('dob', new DateTimeFormatterStrategy('Y-m-d'));
        return $hydrator;
    }
}
