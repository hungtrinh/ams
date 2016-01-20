<?php

namespace Achievement\Student\Mapper;

use Zend\Stdlib\Hydrator\HydratorPluginManager;
use Zend\Stdlib\Hydrator\NamingStrategy\ArrayMapNamingStrategy;
use Zend\Stdlib\Hydrator\Strategy\DateTimeFormatterStrategy;
use Zend\Stdlib\Hydrator\Strategy\ClosureStrategy;
use Achievement\Account\Model\AccountBasicModel;

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
        $account = new AccountBasicModel;
        
        /* @var $hydrator \Zend\Stdlib\Hydrator\ClassMethods */
        $hydrator = $hydrators->get('classmethods');

        $extractAccount = function ($account) use ($hydrator) {
            return $hydrator->extract($account);
        };
        $hydrateAccount = function ($data) use ($hydrator, $account) {
            return $hydrator->hydrate($data, $account);
        };

        $classmethods = new \Zend\Stdlib\Hydrator\ClassMethods();
        $hydrator->setNamingStrategy($namingStrategy);
        $hydrator->addStrategy('dob', new DateTimeFormatterStrategy('Y-m-d'));
        $hydrator->addStrategy('account', new ClosureStrategy($extractAccount, $hydrateAccount));

        return $hydrator;
    }
}
