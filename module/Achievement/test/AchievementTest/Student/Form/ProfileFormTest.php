<?php

namespace AchievementTest\Student\Form;

use Achievement\Student\Model\ProfileInterface;
use AchievementTest\Controller\AbstractHttpControllerTestCase as TestCase;
use Achievement\Student\Form\ProfileForm;
use Achievement\Student\Form\ProfileFieldset;
use Zend\Form\Element;
use DateTime;

class ProfileFormTest extends TestCase
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
            ], //account
        ], //student
    ]; //expectedEmptyFormErrorMessages

    /**
     * @var \Zend\ServiceManager\ServiceLocatorInterface
     */
    protected $locator;

    protected function setUp()
    {
        parent::setUp();
        $this->locator =  $this->getApplicationServiceLocator();
        $this->studentForm = $this->locator->get(ProfileForm::class);
        $this->prepaireValidProfileData();
    }
    
    protected function getDataSet()
    {
        return $this->createArrayDataSet([
            'user' => [
                ['username' => '1234568', 'password' => '1234567'],
                ['username' => '8654321', 'password' => '1234567'],
            ]
        ]);
    }

    private function prepaireValidProfileData()
    {
        $this->profileValid = include(
            "module/Achievement/test/AchievementTest/_fixtures/validStudentProfile.php"
        );
        $this->profileValid['security'] = $this->studentForm->get(ProfileForm::SECURITY)->getValue();
    }

    public function testHasStudentElementIsAStudentFieldset()
    {
        $expectedStudentField = $this->locator->get(ProfileFieldset::class);

        $this->assertSame($expectedStudentField, $this->studentForm->get(ProfileForm::STUDENT));
        $this->assertInstanceOf(Element\Csrf::class, $this->studentForm->get(ProfileForm::SECURITY));
        $this->assertInstanceOf(Element\Submit::class, $this->studentForm->get(ProfileForm::SUBMIT));
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

        $expectedAccount = new \Achievement\Account\Model\AccountBasicModel;
        $expectedAccount->setId($this->profileValid['student']['account']['id']);
        $expectedAccount->setUsername($this->profileValid['student']['account']['username']);
        $expectedAccount->setPassword($this->profileValid['student']['account']['password']);

        $this->assertEquals('1234567', $studentProfile->getRegistrationCode());
        $this->assertEquals('Yoshikuni', $studentProfile->getPhoneticName());
        $this->assertEquals('吉国', $studentProfile->getFullname());
        $this->assertEquals(DateTime::createFromFormat('Y-m-d', '1985-01-18'), $studentProfile->getDob());
        $this->assertEquals('male', $studentProfile->getGender());
        $this->assertEquals(1, $studentProfile->getGrade());
        $this->assertEquals($expectedAccount, $studentProfile->getAccount());

    }

    public function testHasConstStudentSupportAccessToStudentElement()
    {
        $this->assertEquals('student', ProfileForm::STUDENT);
    }

    public function testHasConstSecuritySupportAccessToSecurityElement()
    {
        $this->assertEquals('security', ProfileForm::SECURITY);
    }

    public function testHasConstSubmitSupportAccessToSubmitElement()
    {
        $this->assertEquals('add', ProfileForm::SUBMIT);
    }
}
