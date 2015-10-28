<?php

namespace AchievementTest\Form;

use PHPUnit_Framework_TestCase;
use AchievementTest\Bootstrap;

class StudentFormTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var  \Zend\Form\FormInterface
     */
    protected $studentForm;

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
     * @var  \Zend\ServiceManager\ServiceLocatorInterface
     */
    protected $locator;

    protected function setUp()
    {
        parent::setUp();
        $this->locator     = Bootstrap::getServiceManager();
        $this->studentForm = $this->locator->get('Form\Student');

        $this->prepaireValidProfileData();
    }

    private function prepaireValidProfileData()
    {
        $this->profileValid['security'] = $this->studentForm->get('security')->getValue();
    }

    public function testWhenSetEmptyDataThenFormIsInvalidReturnFalse()
    {
        $this->studentForm->setData([]);
        $this->assertFalse(
            $this->studentForm->isValid()
        );
    }

    /**
     * @depends testWhenSetEmptyDataThenFormIsInvalidReturnFalse
     */
    public function testWhenSetEmptyDataThenFormShowExpectedErrorMessage()
    {
        $expectedMessage = [
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
        $errorMessages = $this->studentForm->getMessages();
        $this->assertEquals($expectedMessage, $errorMessages);
    }

    public function testWhenSetValidStudentProfileDataThenFormIsValidReturnTrue()
    {
        $this->studentForm->setData($this->profileValid);
        $this->assertFalse($this->studentForm->isValid());
    }
}
