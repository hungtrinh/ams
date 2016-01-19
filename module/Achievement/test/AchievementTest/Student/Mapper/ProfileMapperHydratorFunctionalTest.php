<?php

namespace AchievementTest\Student\Mapper;

use PHPUnit_Framework_TestCase as TestCase;
use AchievementTest\Bootstrap;
use Achievement\Student\Hydrator;

class ProfileMapperHydratorFunctionalTest extends TestCase
{
    /**
     * @var \Zend\StdClass\Hydrator\HydratorInterface
     */
    protected $profileMapperHydrator;

    /**
     * @var \Achievement\Student\Model\ProfileInterface
     */
    protected $profile;

    protected function setUp()
    {
        parent::setUp();
        $services = Bootstrap::getServiceManager();
        $hydrators = $services->get('HydratorManager');
        $this->profileMapperHydrator = $hydrators->get(Hydrator::PROFILE_MAPPER_HYDRATOR);
        $this->profile = include "module/Achievement/test/AchievementTest/_fixtures/ValidProfileModel.php";
    }

    public function testWhenCallExtractThenReturnSqlProfileColumnStruct()
    {
        $persitProfile = $this->profileMapperHydrator->extract($this->profile);
        $expectedProfileStruct = [
            'fullname' => $this->profile->getFullname(),
            'phonetic_name' => $this->profile->getPhoneticName(),
            'dob' => $this->profile->getDob()->format('Y-m-d'),
            'gender' => $this->profile->getGender(),
            'grade' => $this->profile->getGrade(),
            'registration_code' => $this->profile->getRegistrationCode(),
            'account' => [
                'id' => $this->profile->getAccount()->getId(),
                'username' => $this->profile->getAccount()->getUsername(),
                'password' => $this->profile->getAccount()->getPassword(),
            ]
        ];

        $this->assertEquals($expectedProfileStruct, $persitProfile);
    }
}
