<?php

namespace AchievementTest\Student\Form;

use Achievement\Student\Model\ProfileInterface;
use AchievementTest\Controller\AbstractHttpControllerTestCase as TestCase;
use Achievement\Student\Form\ProfileForm;
use Achievement\Student\Form\ProfileFieldset;
use Achievement\Account\Model\AccountBasicModel;
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
     * Full fill student form
     * @var []
     */
    protected $fullfillProfileValid;
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
        $this->prepaireFullFillValidProfileData();
    }
    
    /**
     * Prepaire database record
     */
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

    protected function prepaireFullFillValidProfileData()
    {
        $this->fullfillProfileValid = $this->profileValid;
        $this->fullfillProfileValid['student']['siblings'] = [
            [
                'fullname' => 'binh',
                'dob' => '1982-07-15',
                'work' => 'programmer',
                'relationship' => 'brother'
            ],
            [
                'fullname' => 'quynh',
                'dob' => '1979-12-15',
                'work' => 'officer',
                'relationship' => 'sister'
            ],
        ];
    }

    public function testHasStudentIsAStudentFieldset()
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
        $expectedAccount = AccountBasicModel::createFromArray($this->profileValid['student']['account']);
        $this->assertEquals('1234567', $studentProfile->getRegistrationCode());
        $this->assertEquals('Yoshikuni', $studentProfile->getPhoneticName());
        $this->assertEquals('吉国', $studentProfile->getFullname());
        $this->assertEquals('1985-01-18', $studentProfile->getDob()->format('Y-m-d'));
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

    public function testWhenSubmitFullFormWithValidProfileThenGetFormDataReturnExpectedProfileEntity()
    {
        $this->studentForm->setData($this->fullfillProfileValid);
        $this->assertTrue($this->studentForm->isValid());
        $profile = $this->studentForm->getData();
        $this->assertNotNull($profile->getSiblings());
    }
}
