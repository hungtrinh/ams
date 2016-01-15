<?php

namespace AchievementTest\Student\Form;

use PHPUnit_Framework_TestCase as TestCase;
use AchievementTest\Bootstrap;
use Achievement\Student\Form\ProfileFieldset;
use Achievement\Student\Hydrator;
use Zend\Form\FieldsetInterface;

class ProfileFieldsetTest extends TestCase
{
    /**
     * @var \Zend\Form\FieldsetInterface
     */
    protected $studentFieldset;

    protected function setUp()
    {
        parent::setUp();
        $forms = Bootstrap::getServiceManager();
        $this->studentFieldset = $forms->get(ProfileFieldset::class);
    }

    public function testIsAnInstanceOfFieldsetInterface()
    {
        $this->assertInstanceOf(FieldsetInterface::class, $this->studentFieldset);
    }

    public function testUseStudentFormHydrator()
    {
        $hydrators = Bootstrap::getServiceManager()->get('HydratorManager');
        $expectedHydrator = $hydrators->get(Hydrator::PROFILE_FORM_HYDRATOR);
        $hydrator = $this->studentFieldset->getHydrator();
        $this->assertEquals($expectedHydrator, $hydrator);
    }

    public function testHasConstRegistrationCode()
    {
        $this->assertEquals('registration-code', ProfileFieldset::REGISTRATION_CODE);
    }

    public function testHasConstFullname()
    {
        $this->assertEquals('fullname', ProfileFieldset::FULLNAME);
    }

    public function testHasConstPhoneticName()
    {
        $this->assertEquals('phonetic-name', ProfileFieldset::PHONETIC_NAME);
    }

    public function testHasConstDob()
    {
        $this->assertEquals('dob', ProfileFieldset::DATE_OF_BIRTH);
    }

    public function testHasConstGender()
    {
        $this->assertEquals('gender', ProfileFieldset::GENDER);
    }

    public function testHasConstGrade()
    {
        $this->assertEquals('grade', ProfileFieldset::GRADE);
    }

    public function testHasConstSiblings()
    {
        $this->assertEquals('siblings', ProfileFieldset::SIBLINGS);
    }

    public function testHasConstAccount()
    {
        $this->assertEquals('account', ProfileFieldset::ACCOUNT);
    }

    public function testHasConstCourses()
    {
        $this->assertEquals('courses', ProfileFieldset::COURSES);
    }
}
