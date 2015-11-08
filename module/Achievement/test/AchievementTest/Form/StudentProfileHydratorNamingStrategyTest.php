<?php

namespace AchievementTest\Form;

use PHPUnit_Framework_TestCase;
use AchievementTest\Bootstrap;

class StudentProfileHydratorNamingStrategyTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Zend\Stdlib\Hydrator\HydratorInterface
     */
    protected $hydrator;

    protected function setUp()
    {
        $hydratorManager = Bootstrap::getServiceManager()->get('HydratorManager');
        $this->hydrator = $hydratorManager->get('Achievement\Student\Form\StudentProfileHydrator');
    }

    public function testWhenCallHydratorOnHydratorNamingStrategyWillReturnExpectedStudentModelField()
    {
        $namingStrategy = $this->hydrator->getNamingStrategy();

        $this->assertEquals('registrationCode', $namingStrategy->hydrate('registration-code'));
        $this->assertEquals('phoneticName', $namingStrategy->hydrate('phonetic-name'));
        $this->assertEquals('fullname', $namingStrategy->hydrate('fullname'));
        $this->assertEquals('dob', $namingStrategy->hydrate('dob'));
        $this->assertEquals('gender', $namingStrategy->hydrate('gender'));
        $this->assertEquals('grade', $namingStrategy->hydrate('grade'));
        $this->assertEquals('account', $namingStrategy->hydrate('account'));
    }

    public function testWhenCallExtractOnHydratorNamingStrategyWillReturnExpectedStudentElementFieldName()
    {
        $namingStrategy = $this->hydrator->getNamingStrategy();

        $this->assertEquals('registration-code', $namingStrategy->extract('registrationCode'));
        $this->assertEquals('phonetic-name', $namingStrategy->extract('phoneticName'));
        $this->assertEquals('fullname', $namingStrategy->extract('fullname'));
        $this->assertEquals('dob', $namingStrategy->extract('dob'));
        $this->assertEquals('gender', $namingStrategy->extract('gender'));
        $this->assertEquals('grade', $namingStrategy->extract('grade'));
        $this->assertEquals('account', $namingStrategy->extract('account'));
    }
}
