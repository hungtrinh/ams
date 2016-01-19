<?php

namespace AchievementTest\Student\Mapper;

use Achievement\Student\Model\Profile;
use Achievement\Account\Model\AccountBasicModel;
use AchievementTest\Bootstrap;
use AchievementTest\DbConnectionTrait;
use Achievement\Student\Mapper\ProfilePersitInterface;

use PHPUnit_Extensions_Database_TestCase as TestCase;
use DateTime;

class ProfilePersitTableGatewayTest extends TestCase
{
    use DbConnectionTrait;
    /**
     * @var \Achievement\Student\Model\ProfileInterface
     */
    protected $profileValid;

    /**
     * @var \Achievement\Student\Mapper\ProfilePersitInterface
     */
    protected $profilePersitTableGateway;

    protected function setUp()
    {
        parent::setUp();
        $this->profileValid = $this->createProfileValid();
        $services = Bootstrap::getServiceManager();
        $this->profilePersitTableGateway = $services->get(ProfilePersitInterface::class);
    }
    
    /**
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    protected function getDataSet()
    {
        return $this->createArrayDataSet([
            'user' => [],
            'student' => [],
        ]);
    }
    
    /**
     * @return \Achievement\Student\Model\ProfileInterface
     */
    protected function createProfileValid()
    {
        $rawProfile = include "module/Achievement/test/AchievementTest/_fixtures/validStudentProfile.php";
        $account = new AccountBasicModel;
        $profile = new Profile();

        $account->setPassword($rawProfile['student']['account']['password']);
        $account->setUsername($rawProfile['student']['account']['username']);
        $profile->setAccount($account);
        $profile->setDob(DateTime::createFromFormat('Y-m-d', $rawProfile['student']['dob']));
        $profile->setGender($rawProfile['student']['gender']);
        $profile->setGrade($rawProfile['student']['grade']);
        $profile->setFullname($rawProfile['student']['fullname']);
        $profile->setPhoneticName($rawProfile['student']['phonetic-name']);
        $profile->setRegistrationCode($rawProfile['student']['registration-code']);

        return $profile;
    }
    
    /**
     * @return PHPUnit_Extensions_Database_DataSet_ArrayDataSet
     */
    protected function createExpectedDataSet()
    {
        $rawProfile = include "module/Achievement/test/AchievementTest/_fixtures/validStudentProfile.php";
        return $this->createArrayDataSet([
           'user' => [
                [
                    'user_id' => 1,
                    'username' => $rawProfile['student']['account']['username'],
                    'password' => $rawProfile['student']['account']['password'],
                ],
            ],
            'student' => [
                [
                    'id' => 1,
                    'fullname' => $rawProfile['student']['fullname'],
                    'phonetic_name' => $rawProfile['student']['phonetic-name'],
                    'gender' => $rawProfile['student']['gender'],
                    'grade' => $rawProfile['student']['grade'],
                    'dob' => $rawProfile['student']['dob'],
                    'registration_code' => $rawProfile['student']['registration-code'],
                ],
            ]
        ]);
    }

    public function testInstanceOfProfilePersitInterface()
    {
        $this->assertInstanceOf(ProfilePersitInterface::class, $this->profilePersitTableGateway);
    }

    public function testWhenAddNewProfileThenAllProfileInfoStoredToSqlPersistent()
    {
        $this->profilePersitTableGateway->addNew($this->profileValid);
        $this->assertTableRowCount('user', 1);
        $this->assertTableRowCount('student', 1);
        
        $actualDataset = $this->getConnection()->createDataSet(['user','student']);
        $this->assertDataSetsEqual($this->createExpectedDataSet(), $actualDataset);
    }
}
