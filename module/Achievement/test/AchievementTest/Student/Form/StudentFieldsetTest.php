<?php

namespace AchievementTest\Student\Form;

use PHPUnit_Framework_TestCase as TestCase;
use AchievementTest\Bootstrap;
use Zend\Form\FieldsetInterface;

class StudentFieldsetTest extends TestCase
{
    /**
     * @var \Zend\Form\FieldsetInterface
     */
    protected $studentFieldset;

    protected function setUp()
    {
        parent::setUp();
        $forms = Bootstrap::getServiceManager();
        $this->studentFieldset = $forms->get('Achievement\Form\StudentFieldset');
    }

    public function testIsAnInstanceOfFieldsetInterface()
    {
        $this->assertInstanceOf(FieldsetInterface::class, $this->studentFieldset);
    }

    public function testUseStudentFormHydrator()
    {
        $hydrators = Bootstrap::getServiceManager()->get('HydratorManager');
        $expectedHydrator = $hydrators->get('Achievement\Student\Hydrator\ProfileForm');
        $hydrator = $this->studentFieldset->getHydrator();
        $this->assertEquals($expectedHydrator, $hydrator);
    }
}
