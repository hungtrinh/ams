<?php

namespace AchievementTest\Student;

use PHPUnit_Framework_TestCase as TestCase;
use AchievementTest\Bootstrap;
use Zend\InputFilter\InputFilterInterface;
use Achievement\Student\InputFilter;

class ProfileFormInputFilterTest extends TestCase
{
    /**
     * @var \Zend\InputFilter\InputFilterInterface
     */
    protected $studentInputFilter;

    protected function setUp()
    {
        Bootstrap::init();
        $services = Bootstrap::getServiceManager();
        $services->setAllowOverride(true);
        $services->setService('ams', $this->prophesize(\Zend\Db\Adapter\Adapter::class)->reveal());
        $inputFilters = $services->get('InputFilterManager');
        $this->studentInputFilter = $inputFilters->get(InputFilter::STUDENT_FORM_INPUT_FILTER);
    }

    /**
     * Get raw data validate profile user will submit by web form
     * @return []
     */
    protected function getFixtureValidProfile()
    {
        return include(realpath("module/Achievement/test/AchievementTest/_fixtures/validStudentProfile.php"));
    }

    protected function setInvidualValidOnStudentFieldSet($fieldName, $fieldValue)
    {
        $this->studentInputFilter->setValidationGroup([
            'student' => $fieldName
        ]);
        $this->studentInputFilter->setData([
            'student' => [
                $fieldName => $fieldValue,
            ]
        ]);
    }

    protected function setInvidualValidOnAccountFieldSet($fieldName, $fieldValue)
    {
        $this->studentInputFilter->setValidationGroup([
            'student' => [
                'account' => $fieldName,
            ]
        ]);
        $this->studentInputFilter->setData([
            'student' => [
                'account' => [
                    $fieldName => $fieldValue,
                ]
            ]
        ]);
    }

    protected function validateOnlyRegistrationCodeWith($registerCode)
    {
        $this->setInvidualValidOnStudentFieldSet(
            'registration-code',
            $registerCode
        );
    }

    protected function validateOnlyPhoneticNameWith($phoneticName)
    {
        $this->setInvidualValidOnStudentFieldSet(
            'phonetic-name',
            $phoneticName
        );
    }

    protected function validateOnlyFullnameWith($fullname)
    {
        $this->setInvidualValidOnStudentFieldSet('fullname', $fullname);
    }

    public function testIsAnInstanceInputFilterInterface()
    {
        $this->assertInstanceOf(
            InputFilterInterface::class,
            $this->studentInputFilter
        );
    }

    public function testRegistrationCodeIsRequired()
    {
        $emptyString = '';
        $this->validateOnlyRegistrationCodeWith($emptyString);
        $this->assertFalse($this->studentInputFilter->isValid());
        $this->assertArrayHasKey(
            'isEmpty',
            $this->studentInputFilter->getMessages()['student']['registration-code']
        );
    }

    public function testRegistrationCodeIsRequiredAndNotAcceptWhiteSpace()
    {
        $threeSpace = '   ';
        $this->validateOnlyRegistrationCodeWith($threeSpace);
        $this->assertFalse($this->studentInputFilter->isValid());
        $this->assertArrayHasKey(
            'isEmpty',
            $this->studentInputFilter->getMessages()['student']['registration-code']
        );
    }

    public function testPhoneticNameIsRequired()
    {
        $emptyString = '';
        $this->validateOnlyPhoneticNameWith($emptyString);
        $this->assertFalse($this->studentInputFilter->isValid());
        $this->assertArrayHasKey(
            'isEmpty',
            $this->studentInputFilter->getMessages()['student']['phonetic-name']
        );
    }

    public function testFullnameIsRequired()
    {
        $emptyString = '';
        $this->validateOnlyFullnameWith($emptyString);
        $this->assertFalse($this->studentInputFilter->isValid());
        $this->assertArrayHasKey(
            'isEmpty',
            $this->studentInputFilter->getMessages()['student']['fullname']
        );
    }

    public function testDobIsRequired()
    {
        $this->setInvidualValidOnStudentFieldSet('dob', '');
        $this->assertFalse($this->studentInputFilter->isValid());
        $this->assertArrayHasKey(
            'isEmpty',
            $this->studentInputFilter->getMessages()['student']['dob']
        );
    }

    public function testDobValidFormatYmd()
    {
        $this->setInvidualValidOnStudentFieldSet('dob', '1985-01-18');
        $this->assertTrue($this->studentInputFilter->isValid());
    }

    public function testDobValidFormatYmdButWrongDateValue()
    {
        $this->setInvidualValidOnStudentFieldSet('dob', '2015-02-29');
        $this->assertFalse($this->studentInputFilter->isValid());
        $this->assertArrayHasKey(
            'dateInvalidDate',
            $this->studentInputFilter->getMessages()['student']['dob']
        );
    }

    public function testUsernameIsRequired()
    {
        $this->setInvidualValidOnAccountFieldSet('username', '');
        $this->assertFalse($this->studentInputFilter->isValid());
        $this->assertArrayHasKey(
            'isEmpty',
            $this->studentInputFilter->getMessages()['student']['account']['username']
        );
    }

    public function testSiblingsIsNotRequired()
    {
        $this->studentInputFilter->setValidationGroup([
            'student' => ['siblings']
        ]);
        $this->studentInputFilter->setData([
            'student' => [
                'fullname' => 'hungtd',
            ],
        ]);
        $this->assertTrue($this->studentInputFilter->isValid());
    }

    public function testSiblingsDobFormatIsYmd()
    {
        $this->studentInputFilter->setValidationGroup([
            'student' => [
                'siblings' => ['dob'],
            ]
        ]);
        $this->studentInputFilter->setData([
            'student' => [
                'siblings' => [
                    0 => [
                        'dob' =>  'invalid day format',
                    ],
                ],
            ],
        ]);
        $this->assertFalse($this->studentInputFilter->isValid());

        $this->studentInputFilter->setData([
            'student' => [
                'siblings' => [
                    0 => [
                        'dob' =>  '2016-02-29',
                    ],
                ],
            ],
        ]);
        $this->assertTrue($this->studentInputFilter->isValid());
    }
}
