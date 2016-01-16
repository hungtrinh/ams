<?php

namespace AchievementTest\Student\Form;

use PHPUnit_Framework_TestCase;
use AchievementTest\Bootstrap;
use Achievement\Student\Form\ProfileFormHydratorFactory;
use Zend\Stdlib\Hydrator;

class ProfileFormHydratorFactoryTest extends PHPUnit_Framework_TestCase
{
    protected $hydratorManager;

    protected $factory;

    protected function setUp()
    {
        parent::setUp();
        $this->hydratorManager = Bootstrap::getServiceManager()->get('HydratorManager');
        $this->factory           = new ProfileFormHydratorFactory();
    }

    public function testCallInvokeReturnClassMethodHydratorInstance()
    {
        $studentFormHydrator = $this->factory->__invoke($this->hydratorManager);
        $this->assertInstanceOf(Hydrator\ClassMethods::class, $studentFormHydrator);
    }
}
