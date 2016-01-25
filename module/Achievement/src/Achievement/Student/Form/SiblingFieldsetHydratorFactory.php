<?php

namespace Achievement\Student\Form;

use Zend\Stdlib\Hydrator\HydratorPluginManager;
use Zend\Stdlib\Hydrator\NamingStrategy\ArrayMapNamingStrategy;
use Zend\Stdlib\Hydrator\Strategy\DateTimeFormatterStrategy;

/**
 * Create an concrete hydrator object support convert:
 * - Bind (hidrate) raw sibling fieldset data to concrete
 * object implement \Achievement\Student\Model\Sibling
 * - extract data from object implement \Achievement\Student\Model\Sibling
 * to raw array sibling
 */
class SiblingFieldsetHydratorFactory
{
    /**
     * @param HydratorPluginManager $hydrators
     * @return \Zend\Std\Hydrator\ClassMethods
     */
    public function __invoke(HydratorPluginManager $hydrators)
    {
        /* @var $hydrator \Zend\Stdlib\Hydrator\ClassMethods */
        $hydrator = $hydrators->get('classmethods');
        $hydrator->addStrategy('dob', new DateTimeFormatterStrategy('Y-m-d'));
        return $hydrator;
    }
}
