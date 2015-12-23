<?php

namespace AchievementTest\Student\Hydrator;

use PHPUnit_Framework_TestCase;
use AchievementTest\Bootstrap;
use Achievement\Student\Hydrator\ProfileFormFactory;
use Zend\Stdlib\Hydrator;

class ProfileFormFactoryTest extends PHPUnit_Framework_TestCase
{
    protected $hydratorManager;

    protected $factory;

    protected function setUp()
    {
        parent::setUp();
        $this->hydratorManager = Bootstrap::getServiceManager()->get('HydratorManager');
        $this->factory           = new ProfileFormFactory();
    }

    public function testCallInvokeReturnClassMethodHydratorInstance()
    {
        $studentFormHydrator = $this->factory->__invoke($this->hydratorManager);
        $this->assertInstanceOf(Hydrator\ClassMethods::class, $studentFormHydrator);
    }
}
