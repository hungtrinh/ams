<?php

namespace Achievement\Student\Form;

use Zend\Stdlib\Hydrator\HydratorPluginManager;
use Zend\Stdlib\Hydrator\NamingStrategy\ArrayMapNamingStrategy;
use Zend\Stdlib\Hydrator\Strategy\DateTimeFormatterStrategy;

/**
 * Create an concrete hydrator object support convert:
 * - Bind (hidrate) raw student profile form data to concrete
 * object implement \Achievement\Student\Model\ProfileInterface
 * - extract data from object implement \Achievement\Student\Model\ProfileInterface
 * to raw array student profile
 */
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
