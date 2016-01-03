<?php

namespace AchievementTest\Student\InputFilter;

use PHPUnit_Framework_TestCase as TestCase;
use AchievementTest\Bootstrap;
use Zend\InputFilter\InputFilterInterface;

class StudentTest extends TestCase
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
        $this->studentInputFilter = $inputFilters->get('Achievement\InputFilter\Student');
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

    public function testUsernameIsRequired()
    {
        $this->setInvidualValidOnAccountFieldSet('username', '');
        $this->assertFalse($this->studentInputFilter->isValid());
        $this->assertArrayHasKey(
            'isEmpty',
            $this->studentInputFilter->getMessages()['student']['account']['username']
        );
    }
}
