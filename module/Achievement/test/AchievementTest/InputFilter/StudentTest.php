<?php

namespace AchievementTest\InputFilter;

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
        $serviceManager = Bootstrap::getServiceManager();
        $inputFilterManger = $serviceManager->get('InputFilterManager');
        $this->studentInputFilter = $inputFilterManger->get('Achievement\InputFilter\Student');
    }

    protected function setupInvidualValidOnStudentFieldSet($fieldName, $fieldValue)
    {
        $this->studentInputFilter->setValidationGroup(['student' => $fieldName ]);
        $this->studentInputFilter->setData([
            'student' => [
                $fieldName => $fieldValue,
            ]
        ]);
    }

    protected function validateOnlyRegistrationCodeWith($registerCode)
    {
        $this->setupInvidualValidOnStudentFieldSet('registration-code', $registerCode);
    }

    protected function validateOnlyPhoneticNameWith($phoneticName)
    {
        $this->setupInvidualValidOnStudentFieldSet('phonetic-name', $phoneticName);
    }

    protected function validateOnlyFullnameWith($fullname)
    {
        $this->setupInvidualValidOnStudentFieldSet('fullname', $fullname);
    }

    public function testIsAnInstanceInputFilterInterface()
    {
        $this->assertInstanceOf(InputFilterInterface::class, $this->studentInputFilter);
    }

    public function testRegistrationCodeIsRequired()
    {
        $emptyString = '';
        $this->validateOnlyRegistrationCodeWith($emptyString);
        $this->assertFalse($this->studentInputFilter->isValid());
        $this->assertArrayHasKey('isEmpty', $this->studentInputFilter->getMessages()['student']['registration-code']);
    }

    public function testRegistrationCodeIsRequiredAndNotAcceptWhiteSpace()
    {
        $threeSpace = '   ';
        $this->validateOnlyRegistrationCodeWith($threeSpace);
        $this->assertFalse($this->studentInputFilter->isValid());
        $this->assertArrayHasKey('isEmpty', $this->studentInputFilter->getMessages()['student']['registration-code']);
    }

    public function testPhoneticNameIsRequired()
    {
        $emptyString = '';
        $this->validateOnlyPhoneticNameWith($emptyString);
        $this->assertFalse($this->studentInputFilter->isValid());
        $this->assertArrayHasKey('isEmpty', $this->studentInputFilter->getMessages()['student']['phonetic-name']);
    }

    public function testFullnameIsRequired()
    {
        $emptyString = '';
        $this->validateOnlyFullnameWith($emptyString);
        $this->assertFalse($this->studentInputFilter->isValid());
        $this->assertArrayHasKey('isEmpty', $this->studentInputFilter->getMessages()['student']['fullname']);
    }

    public function testWhenCallIsValidWithValidProfileThenReturnTrue()
    {
        $validProfile = include(realpath("module/Achievement/test/AchievementTest/_fixtures/validStudentProfile.php"));
        $this->assertTrue($this->studentInputFilter->setData($validProfile)->isValid());
    }

    public function testIsValidWillReturnFalseWhenInjectUsernameDifferenceSeventNumber()
    {
        $inValidProfile = include(realpath("module/Achievement/test/AchievementTest/_fixtures/validStudentProfile.php"));
        $inValidProfile['student']['account']['username'] = 'abcdef';
        $this->assertFalse($this->studentInputFilter->setData($inValidProfile)->isValid());
    }
}
