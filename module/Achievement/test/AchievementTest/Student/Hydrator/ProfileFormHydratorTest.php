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

    protected $rawProfile = [
        'registration-code'  => '1234567',
        'phonetic-name'  => 'Yoshikuni',
        'fullname'  => '吉国',
        'dob' => '1985-01-18',
        'gender' => 'male',
        'grade' => 1,
        'account' => [
            'id' => 1,
            'username' => '1234567',
            'password' => '1234',
        ],
        'courses' => [
            ['code' => 1],
            ['code' => 2],
            ['code' => 3],
        ],//courses
        'siblings' => [
            [
                'fullname' => 'Trinh Duc Anh',
                'dob' => '1982-01-02',
                'work' => 'By himself',
                'relationship' => 'brother'
            ],
            [
                'fullname' => 'Trinh Thi Nhan',
                'dob' => '1981-01-02',
                'work' => 'By herself',
                'relationship' => 'sister'
            ]
        ],//siblings
    ];

    protected function setUp()
    {
        Bootstrap::init();
        $services = Bootstrap::getServiceManager();
        $hydrators = $services->get('HydratorManager');
        $this->hydrator = $hydrators->get(Hydrator::PROFILE_FORM_HYDRATOR);
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
    
    public function testWhenCallHydrateWithYmdStringThenRecieveDateTimeObjectInModel()
    {
        $studentProfile = new Profile();
        $dobRaw = '1985-12-31';
        $dobExpected = DateTime::createFromFormat('Y-m-d', $dobRaw);
        $this->hydrator->hydrate(['dob' => $dobRaw], $studentProfile);
        $this->assertEquals($dobExpected, $studentProfile->getDob());
    }

    public function testWhenCallHydrateWithRawStudentProfileThenReturnProfileModel()
    {
        $studentProfile = new Profile();
        $this->hydrator->hydrate($this->rawProfile, $studentProfile);

        $this->assertEquals('1234567', $studentProfile->getRegistrationCode());
        $this->assertEquals('Yoshikuni', $studentProfile->getPhoneticName());
        $this->assertEquals('吉国', $studentProfile->getFullname());
        $this->assertEquals(DateTime::createFromFormat('Y-m-d', '1985-01-18'), $studentProfile->getDob());
        $this->assertEquals('male', $studentProfile->getGender());
        $this->assertEquals([
            'id' => 1,
            'username' => '1234567',
            'password' => '1234',
        ], $studentProfile->getAccount());
        $this->assertEquals([
            'id' => 1,
            'username' => '1234567',
            'password' => '1234',
        ], $studentProfile->getAccount());
    }
}
