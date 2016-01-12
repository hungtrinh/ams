<?php

namespace AchievementTest\Student\Form;

use Achievement\Student\Model\ProfileInterface;
use AchievementTest\Controller\AbstractHttpControllerTestCase as TestCase;
use Achievement\Student\Form\StudentForm;
use Zend\Form\Element;
use DateTime;

class StudentFormTest extends TestCase
{
    /**
     * @var \Zend\Form\FormInterface
     */
    protected $studentForm;

    /**
     * Valid student profile user will submit
     *
     * @var []
     */
    protected $profileValid;

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
            'phonetic-name'  => [
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

    /**
     * @var \Zend\ServiceManager\ServiceLocatorInterface
     */
    protected $locator;

    protected function setUp()
    {
        parent::setUp();
        $this->locator =  $this->getApplicationServiceLocator();
        $this->studentForm = $this->locator->get('Achievement\Form\Student');
        $this->prepaireValidProfileData();
    }
    
    protected function getDataSet()
    {
        return $this->createArrayDataSet([
            'user' => [
                ['username' => '1234568'],
                ['username' => '8654321'],
            ]
        ]);
    }

    private function prepaireValidProfileData()
    {
        $this->profileValid = include(
            "module/Achievement/test/AchievementTest/_fixtures/validStudentProfile.php"
        );
        $this->profileValid['security'] = $this->studentForm->get(StudentForm::SECURITY)->getValue();
    }

    public function testHasStudentElementIsAStudentFieldset()
    {
        $expectedStudentField = $this->locator->get('Achievement\Form\StudentFieldset');

        $this->assertSame($expectedStudentField, $this->studentForm->get(StudentForm::STUDENT));
        $this->assertInstanceOf(Element\Csrf::class, $this->studentForm->get(StudentForm::SECURITY));
        $this->assertInstanceOf(Element\Submit::class, $this->studentForm->get('add'));
    }

    public function testIsInvalidWhenSetEmptyProfile()
    {
        $emptyProfileData = [];
        $this->studentForm->setData($emptyProfileData);
        $this->assertFalse($this->studentForm->isValid());
    }

    public function testWhenSetEmptyDataThenFormShowExpectedErrorMessage()
    {
        $emptyProfileData = [];
        $this->studentForm->setData($emptyProfileData);
        $this->studentForm->isValid();
        $errorMessages = $this->studentForm->getMessages();
        $this->assertEquals($this->expectedEmptyFormErrorMessages, $errorMessages, print_r($errorMessages, true));
    }

    public function testIsValidWhenSetValidProfile()
    {
        $this->studentForm->setData($this->profileValid);
        $this->assertTrue($this->studentForm->isValid());
    }

    public function testGetDataReturnExpectedStudentProfileEntityWhenSetValidProfile()
    {
        $this->studentForm->setData($this->profileValid);
        $this->studentForm->isValid();

        $studentProfile = $this->studentForm->getData();
        $this->assertInstanceOf(ProfileInterface::class, $studentProfile, print_r($studentProfile, true));

        $this->assertEquals('1234567', $studentProfile->getRegistrationCode());
        $this->assertEquals('Yoshikuni', $studentProfile->getPhoneticName());
        $this->assertEquals('吉国', $studentProfile->getFullname());
        $this->assertEquals(DateTime::createFromFormat('Y-m-d', '1985-01-18'), $studentProfile->getDob());
        $this->assertEquals('male', $studentProfile->getGender());
        $this->assertEquals(1, $studentProfile->getGrade());
        $this->assertEquals([
            'id' => 1,
            'username' => '1234567',
            'password' => '1234',
        ], $studentProfile->getAccount());
    }

    public function testHasConstStudentSupportAccessToStudentElement()
    {
        $this->assertEquals('student', StudentForm::STUDENT);
    }

    public function testHasConstSecuritySupportAccessToSecurityElement()
    {
        $this->assertEquals('security', StudentForm::SECURITY);
    }
}
