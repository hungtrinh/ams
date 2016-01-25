<?php

namespace AchievementTest\Student\Mapper;

use Achievement\Student\Model\Profile;
use Achievement\Account\Model\AccountBasicModel;
use AchievementTest\Bootstrap;
use AchievementTest\DbConnectionTrait;
use Achievement\Student\Mapper\ProfilePersitInterface;

use PHPUnit_Extensions_Database_TestCase as TestCase;
use DateTime;

class ProfilePersitTableGatewayFuncationlTest extends TestCase
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
        $services->setAllowOverride(true);
        $services->setService('ams', $this->getDbAdapter());
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
            'sibling' => [],
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
                    'email' => null,
                    'display_name' => null,
                    'password' => $rawProfile['student']['account']['password'],
                    'state' => null,
                ],
            ],
            'student' => [
                [
                    'id' => 1,
                    'user' => $rawProfile['student']['account']['username'],
                    'registration_code' => $rawProfile['student']['registration-code'],
                    'fullname' => $rawProfile['student']['fullname'],
                    'phonetic_name' => $rawProfile['student']['phonetic-name'],
                    'dob' => $rawProfile['student']['dob'],
                    'gender' => $rawProfile['student']['gender'],
                    'grade' => $rawProfile['student']['grade'],
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

    public function testWhenAddNewProfileMissingAccountPartInfoThenNoThingKeepTrack()
    {
        $this->assertTableRowCount('user', 0);
        $this->assertTableRowCount('student', 0);

        $invalidProfile = clone $this->profileValid;
        $invalidProfile->setAccount(new AccountBasicModel());
        try {
            $this->profilePersitTableGateway->addNew($invalidProfile);
        } catch (\Exception $e) {
        }
        $this->assertTableRowCount('user', 0);
        $this->assertTableRowCount('student', 0);
    }

    public function testWhenAddNewProfileWithFullOptionThenAllProfileInfoStoredToSqlPersistent()
    {
        $fullValidProfile = include "module/Achievement/test/AchievementTest/_fixtures/fullProfileModelValid.php";
        $siblings = $fullValidProfile->getSiblings();
        $expectedDataSet = $this->createArrayDataSet([
            'user' => [
                [
                    'user_id' => 1,
                    'username' => $fullValidProfile->getAccount()->getUsername(),
                    'email' => null,
                    'display_name' => null,
                    'password' => $fullValidProfile->getAccount()->getPassword(),
                    'state' => null,
                ],
            ],
            'student' => [
                [
                    'id' => 1,
                    'user' => $fullValidProfile->getAccount()->getUsername(),
                    'registration_code' => $fullValidProfile->getRegistrationCode(),
                    'fullname' => $fullValidProfile->getFullname(),
                    'phonetic_name' => $fullValidProfile->getPhoneticName(),
                    'dob' => $fullValidProfile->getDob()->format('Y-m-d'),
                    'gender' => $fullValidProfile->getGender(),
                    'grade' => $fullValidProfile->getGrade(),
                ],
            ],
            'sibling'  => [
                [
                    'id' => 1,
                    'username' => $fullValidProfile->getAccount()->getUsername(),
                    'fullname' => $siblings[0]->getFullname(),
                    'dob' => $siblings[0]->getDob()->format('Y-m-d'),
                    'work' =>  $siblings[0]->getWork(),
                    'relationship' =>  $siblings[0]->getRelationship(),
                ],
                [
                    'id' => 2,
                    'username' => $fullValidProfile->getAccount()->getUsername(),
                    'fullname' => $siblings[1]->getFullname(),
                    'dob' => $siblings[1]->getDob()->format('Y-m-d'),
                    'work' =>  $siblings[1]->getWork(),
                    'relationship' =>  $siblings[1]->getRelationship(),
                ],
            ]
        ]);

        $this->profilePersitTableGateway->addNew($fullValidProfile);
        
        $this->assertTableRowCount('user', 1);
        $this->assertTableRowCount('student', 1);
        $this->assertTableRowCount('sibling', 2);

        $actualDataset = $this->getConnection()->createDataSet(['user','student','sibling']);
        $this->assertDataSetsEqual($expectedDataSet, $actualDataset);
    }
}
