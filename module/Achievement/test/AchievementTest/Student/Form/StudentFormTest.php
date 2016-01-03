<?php

namespace AchievementTest\Student\Form;

//use AchievementTest\Bootstrap;
use Achievement\Student\Model\ProfileInterface;
use AchievementTest\Controller\AbstractHttpControllerTestCase as TestCase;

class StudentFormTest extends TestCase
{
    /**
     * $studentForm get from Bootstrap::getServiceManager()->get('Achievement\Form\Student')
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
//        Bootstrap::init(); //reset service locator
//        $services = Bootstrap::getServiceManager();
        parent::setUp();
        $this->locator =  $this->getApplicationServiceLocator();
        $this->studentForm = $this->locator->get('Achievement\Form\Student');
        $this->prepaireValidProfileData();
    }
    
    protected function getDataSet() {
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
        $this->profileValid['security'] = $this->studentForm->get('security')->getValue();
    }

    public function testHasStudentElementIsAStudentFieldset()
    {
        $expectedStudentField = $this->locator->get('Achievement\Form\StudentFieldset');

        $this->assertSame($expectedStudentField, $this->studentForm->get('student'));
        $this->assertInstanceOf(\Zend\Form\Element\Csrf::class, $this->studentForm->get('security'));
        $this->assertInstanceOf(\Zend\Form\Element\Submit::class, $this->studentForm->get('add'));
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
        $this->assertEquals($this->expectedEmptyFormErrorMessages, $errorMessages, print_r($errorMessages,true));
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
        $this->assertEquals('1985-01-18', $studentProfile->getDob());
        $this->assertEquals('male', $studentProfile->getGender());
        $this->assertEquals(1, $studentProfile->getGrade());
        $this->assertEquals([
            'id' => 1,
            'username' => '1234567',
            'password' => '1234',
        ], $studentProfile->getAccount());
    }
}
