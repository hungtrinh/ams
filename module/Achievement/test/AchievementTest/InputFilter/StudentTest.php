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

    protected function validateRegistrationCodeOnly($registerCode)
    {
        $this->studentInputFilter->setValidationGroup(['student' => 'registration-code' ]);
        $this->studentInputFilter->setData([
            'student' => [
                'registration-code' => $registerCode,
            ]
        ]);
    }

    protected function validatePhoneticNameOnly($phoneticName)
    {
        $this->studentInputFilter->setValidationGroup(['student' => 'phonetic-name' ]);
        $this->studentInputFilter->setData([
            'student' => [
                'phonetic-name' => $phoneticName,
            ]
        ]);
    }

    public function testIsAnInstanceInputFilterInterface()
    {
        $this->assertInstanceOf(InputFilterInterface::class, $this->studentInputFilter);
    }

    public function testRegistrationCodeIsRequired()
    {
        $this->validateRegistrationCodeOnly('');
        $this->assertFalse($this->studentInputFilter->isValid());
        $this->assertArrayHasKey('isEmpty', $this->studentInputFilter->getMessages()['student']['registration-code']);
    }

    public function testPhoneticNameIsRequired()
    {
        $this->validatePhoneticNameOnly('');
        $this->assertFalse($this->studentInputFilter->isValid());
        $this->assertArrayHasKey('isEmpty', $this->studentInputFilter->getMessages()['student']['phonetic-name']);
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
