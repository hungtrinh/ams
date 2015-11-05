<?php

namespace AchievementTest\Form;

use PHPUnit_Framework_TestCase;
use AchievementTest\Bootstrap;

class StudentFormTest extends PHPUnit_Framework_TestCase
{
    /**
     * $studentForm get from Bootstrap::getServiceManager()->get('Form\Student')
     * will return same instance in all test case (get from same ServiceManager instance)
     *
     * When user (form) call getValue on csrf element first time
     * then csrf validator will check if not exist csrf token hash
     * then generate csrf hash and csrf token store in $_SESSION.
     *
     * So  $form->isValid($validData) === true for test case A
     *
     * After Run tesk case default phpunit destroy all global variable.
     * (this line below tell phpunit please backup SESSION for next test case)
     *
     * And then $form->isValid($validData) === false for test case B
     * (because system empty SESSION after test case A)
     */
    protected $backupGlobalsBlacklist = array( '_SESSION' );

    /**
     * @var \Zend\Form\FormInterface
     */
    protected $studentForm;

    /**
     * Valid student profile user will submit
     *
     * @var []
     */
    protected $profileValid = [
        'security' => 'depend on form object',
        'student' => [
            'registration-code'  => '1234567',
            'katakana-name'  => 'Yoshikuni',
            'fullname'  => '吉国',
            'dob' => '1985-01-18',
            'gender' => 'male',
            'grade' => 1,

            'account' => [
                'id' => 1,
                'username' => 'hungtd',
                'password' => '1234',
            ]
        ],
    ];

    /**
     * Expected errors message when user submit empty form
     * @var []
     */
    protected $expectedEmptyFormErrorMessages = [
        'security' => [
            'isEmpty' => "Value is required and can't be empty",
        ],
        'student' => [
            'registration-code'  => [
                'isEmpty' => "Value is required and can't be empty",
            ],
            'katakana-name'  => [
                'isEmpty' => "Value is required and can't be empty",
            ],
            'fullname'  => [
                'isEmpty' => "Value is required and can't be empty",
            ],
            'dob' => [
                'isEmpty' => "Value is required and can't be empty",
            ],
            'gender' => [
                'isEmpty' => "Value is required and can't be empty",
            ],
            'grade' => [
                'isEmpty' => "Value is required and can't be empty",
            ],
            'account' => [
                'username' => [
                    'isEmpty' => "Value is required and can't be empty",
                ],
                'password' => [
                    'isEmpty' => "Value is required and can't be empty",
                ],
            ],
        ],
    ];

    protected function setUp()
    {
        $this->studentForm = Bootstrap::getServiceManager()->get('Form\Student');
        $this->prepaireValidProfileData();
    }

    private function prepaireValidProfileData()
    {
        $this->profileValid['security'] = $this->studentForm->get('security')->getValue();
    }

    public function testWhenSetEmptyDataThenFormIsInvalidReturnFalse()
    {
        $emptyProfileData = [];
        $this->studentForm->setData($emptyProfileData);
        $this->assertFalse($this->studentForm->isValid());
    }

    /**
     * @depends testWhenSetEmptyDataThenFormIsInvalidReturnFalse
     */
    public function testWhenSetEmptyDataThenFormShowExpectedErrorMessage()
    {
        $errorMessages = $this->studentForm->getMessages();
        $this->assertEquals($this->expectedEmptyFormErrorMessages, $errorMessages);
    }

    public function testWhenSetValidStudentProfileDataThenFormIsValidReturnTrue()
    {
        $this->studentForm->setData($this->profileValid);
        $this->assertTrue($this->studentForm->isValid());
    }
}
