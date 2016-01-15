<?php

namespace AchievementTest\Student\Hydrator;

use PHPUnit_Framework_TestCase;
use AchievementTest\Bootstrap;
use Achievement\Student\Model\Profile;
use Achievement\Student\Hydrator;
use DateTime;

class ProfileFormTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Zend\Stdlib\Hydrator\HydratorInterface
     */
    protected $hydrator;

    protected function setUp()
    {
        Bootstrap::init();
        $services = Bootstrap::getServiceManager();
        $hydrators = $services->get('HydratorManager');
        $profileFormHydratorName = Hydrator::PROFILE_FORM_HYDRATOR;
        $this->hydrator = $hydrators->get($profileFormHydratorName);
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
    
    public function testWhenCallHydrateWithNullDobThenNothingBindToDobOnEntity()
    {
        $studentProfile = new Profile();
        $this->hydrator->hydrate(['dob' => null], $studentProfile);
        
        $this->assertNull($studentProfile->getDob());
    }
    
    public function testWhenCallHydrateWithEmptyStringDobThenNothingBindToDobOnEntity()
    {
        $studentProfile = new Profile();
        $this->hydrator->hydrate(['dob' => ''], $studentProfile);
        $this->assertNull($studentProfile->getDob());
    }
    
    public function testWhenCallHydrateWithYmdStringDobThenBindDateTimeObjectToEntity()
    {
        $studentProfile = new Profile();
        $dobRaw = '1985-12-31';
        $dobExpected = DateTime::createFromFormat('Y-m-d', $dobRaw);
        $this->hydrator->hydrate(['dob' => $dobRaw], $studentProfile);
        $this->assertEquals($dobExpected, $studentProfile->getDob());
    }
}
