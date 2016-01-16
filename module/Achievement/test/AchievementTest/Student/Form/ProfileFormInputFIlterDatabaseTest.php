<?php

namespace AchievementTest\Student\Form;

use AchievementTest\Controller\AbstractHttpControllerTestCase as TestCase;
use Achievement\Student\InputFilter;

class ProfileFormInputFIlterDatabaseTest extends TestCase
{
    /**
     * @var \Zend\InputFilter\InputFilterInterface
     */
    protected $studentInputFilter;

    protected function setUp()
    {
        parent::setUp();
        $serviceManager = $this->getApplicationServiceLocator();

        $inputFilterManger = $serviceManager->get('InputFilterManager');
        $this->studentInputFilter = $inputFilterManger->get(InputFilter::STUDENT_FORM_INPUT_FILTER);
    }

    protected function getDataSet()
    {
        return $this->createArrayDataSet([
            'user' => [
                ['username' => '1234568'],
                ['username' => '7654321'],
            ]
        ]);
    }
    
    /**
     * Get raw data validate profile user will submit by web form
     * @return []
     */
    protected function getFixtureValidProfile()
    {
        return include("module/Achievement/test/AchievementTest/_fixtures/validStudentProfile.php");
    }

    public function testStoreHasTwoRecordPrepaired()
    {
        $this->assertEquals(2, $this->getConnection()->getRowCount('user'));
    }

    public function testStateOfTwoRecordPrepaired()
    {
        $queryTable = $this->getConnection()->createQueryTable('user', 'select username from user order by username');
        $expectedTable = $this->createArrayDataSet([
                    'user' => [
                        ['username' => '1234568'],
                        ['username' => '7654321'],
                    ]
                ])->getTable('user');
        $this->assertTablesEqual($expectedTable, $queryTable);
    }
    
    public function testIsInValidWhenInjectUsernameExistedBefore()
    {
        $duplicatedUserName = '1234568';
        $this->studentInputFilter->setValidationGroup([
            'student' => [
                'account' => 'username'
            ]
        ]);
        $this->studentInputFilter->setData([
            'student' => [
                'account' => [
                    'username' => $duplicatedUserName,
                ]
            ]
        ]);
        $this->assertFalse($this->studentInputFilter->isValid());
    }
    
    public function testUsernameIsInvalidWhenDoesNotContainExactly7DigitsCharacterAnsi()
    {
        $inValidProfile = $this->getFixtureValidProfile();
        $inValidProfile['student']['account']['username'] = 'invalid usernamne';

        $this->assertFalse($this->studentInputFilter->setData($inValidProfile)->isValid());
        $errorMessages = $this->studentInputFilter->getMessages();
        $this->assertArrayHasKey(
            'regexNotMatch',
            $errorMessages['student']['account']['username']
        );
        $this->assertEquals(
            'The input must contain only 7 digits',
            $errorMessages['student']['account']['username']['regexNotMatch']
        );
    }
    
    public function testIsValidWithProfileExpected()
    {
        $validProfile = $this->getFixtureValidProfile();
        $this->assertTrue($this->studentInputFilter->setData($validProfile)->isValid());
    }
}
