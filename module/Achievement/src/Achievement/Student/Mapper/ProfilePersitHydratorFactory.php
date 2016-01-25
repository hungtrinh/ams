<?php

namespace Achievement\Student\Mapper;

use Zend\Stdlib\Hydrator\HydratorPluginManager;
use Zend\Stdlib\Hydrator\NamingStrategy\ArrayMapNamingStrategy;
use Zend\Stdlib\Hydrator\Strategy\DateTimeFormatterStrategy;
use Zend\Stdlib\Hydrator\Strategy\ClosureStrategy;
use Achievement\Account\Model\AccountBasicModel;
use Achievement\Student\Model\Sibling;

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
     * @param \Zend\Stdlib\Hydrator\HydratorPluginManager $hydrators
     * @return \Zend\Std\Hydrator\HydratorInterface
     */
    public function __invoke(HydratorPluginManager $hydrators)
    {
        $namingStrategy = new ArrayMapNamingStrategy([
            'registrationCode'  => 'registration_code',
            'phoneticName'      => 'phonetic_name',
        ]);
        /* @var $hydrator \Zend\Stdlib\Hydrator\ClassMethods */
        $hydrator = $hydrators->get('classmethods');

        $hydrator->setNamingStrategy($namingStrategy);
        $hydrator->addStrategy('dob', new DateTimeFormatterStrategy('Y-m-d'));
        $hydrator->addStrategy('account', $this->createAccountHydratorStrategy($hydrator));
        $hydrator->addStrategy('siblings', $this->createSiblingsHydratorStrategy($hydrator));

        return $hydrator;
    }

    /**
     * @param  \Zend\Stdlib\Hydrator\HydratorInterface $hydrator
     * @return \Zend\Stdlib\Hydrator\Strategy\StrategyInterface
     */
    protected function createAccountHydratorStrategy($hydrator)
    {
        $account = new AccountBasicModel;
        $extractAccount = function ($account) use ($hydrator) {
            return $hydrator->extract($account);
        };
        $hydrateAccount = function ($data) use ($hydrator, $account) {
            return $hydrator->hydrate($data, $account);
        };
        return new ClosureStrategy($extractAccount, $hydrateAccount);
    }

    /**
     * @param  \Zend\Stdlib\Hydrator\HydratorInterface $hydrator
     * @return \Zend\Stdlib\Hydrator\Strategy\StrategyInterface
     */
    protected function createSiblingsHydratorStrategy($hydrator)
    {
        $sibling = new Sibling;
        $extractSiblings = function ($siblings) use ($hydrator) {
            $collection = [];
            if (!empty($siblings)) {
                foreach ($siblings as $sibling) {
                    $collection[] = $hydrator->extract($sibling);
                }
            }
            return $collection;
        };
        $hydrateSiblings = function ($datas) use ($hydrator, $sibling) {
            $collection = [];
            if (!empty($datas)) {
                foreach ($datas as $data) {
                    $siblingClone = clone $sibling;
                    $hydrator->hydrate($data, $siblingClone);
                    $collection[] = $siblingClone;
                }
            }
            return $collection;
        };
        return new ClosureStrategy($extractSiblings, $hydrateSiblings);
    }
}
