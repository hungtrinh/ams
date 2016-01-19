<?php

namespace Achievement\Student\Mapper;

use Zend\Stdlib\Hydrator\HydratorPluginManager;
use Zend\Stdlib\Hydrator\NamingStrategy\ArrayMapNamingStrategy;
use Zend\Stdlib\Hydrator\Strategy\DateTimeFormatterStrategy;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;

/**
 * Create an concrete hydrator object support convert:
 * - Bind (hidrate) raw student profile form data to concrete
 * object implement \Achievement\Student\Model\ProfileInterface
 * - extract data from object implement \Achievement\Student\Model\ProfileInterface
 * to raw array student profile
 */
class ProfilePersitHydratorFactory
{
    /**
     * @param HydratorPluginManager $hydrators
     * @return \Zend\Std\Hydrator\ClassMethods
     */
    public function __invoke(HydratorPluginManager $hydrators)
    {
        $namingStrategy = new ArrayMapNamingStrategy([
            'registrationCode'  => 'registration_code',
            'phoneticName'      => 'phonetic_name',
        ]);
        
        /* @var $hydrator \Zend\Stdlib\Hydrator\ClassMethods */
        $hydrator = $hydrators->get('classmethods');
        $classmethods = new \Zend\Stdlib\Hydrator\ClassMethods();
        $hydrator->setNamingStrategy($namingStrategy);
        $hydrator->addStrategy('dob', new DateTimeFormatterStrategy('Y-m-d'));

        $profileMapperHydrator = new AggregateHydrator();
        $profileMapperHydrator->add($hydrator);
        return $profileMapperHydrator;
    }
}
