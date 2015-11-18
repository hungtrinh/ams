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
        $this->setInvidualValidOnStudentFieldSet('registration-code', $registerCode);
    }

    protected function validateOnlyPhoneticNameWith($phoneticName)
    {
        $this->setInvidualValidOnStudentFieldSet('phonetic-name', $phoneticName);
    }

    protected function validateOnlyFullnameWith($fullname)
    {
        $this->setInvidualValidOnStudentFieldSet('fullname', $fullname);
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

    public function testDobIsRequired()
    {
        $this->setInvidualValidOnStudentFieldSet('dob', '');
        $this->assertFalse($this->studentInputFilter->isValid());
        $this->assertArrayHasKey('isEmpty', $this->studentInputFilter->getMessages()['student']['dob']);
    }

    public function testUsernameIsRequired()
    {
        $this->setInvidualValidOnAccountFieldSet('username', '');
        $this->assertFalse($this->studentInputFilter->isValid());
        $this->assertArrayHasKey('isEmpty', $this->studentInputFilter->getMessages()['student']['account']['username']);
    }

    public function testUsernameIsInvalidWhenDoesNotContainExactly7DigitsCharacterAnsi()
    {
        $inValidProfile = include(realpath("module/Achievement/test/AchievementTest/_fixtures/validStudentProfile.php"));
        $inValidProfile['student']['account']['username'] = 'abcdef';

        $this->assertFalse($this->studentInputFilter->setData($inValidProfile)->isValid());
        $errorMessages = $this->studentInputFilter->getMessages();
        $this->assertArrayHasKey('regexNotMatch', $errorMessages['student']['account']['username']);
        $this->assertEquals('The input must contain only 7 digits', $errorMessages['student']['account']['username']['regexNotMatch']);

    }

    public function testIsValidWithProfileExpected()
    {
        $validProfile = include(realpath("module/Achievement/test/AchievementTest/_fixtures/validStudentProfile.php"));
        $this->assertTrue($this->studentInputFilter->setData($validProfile)->isValid());
    }
}
