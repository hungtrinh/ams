<?php

namespace ApplicationTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase as ZendControllerTestCase;
use Zend\Stdlib\Parameters;
use Zend\Db\Adapter\Adapter;
use Achievement\Student\Model\Profile;
use Achievement\Student\Form\ProfileForm;

class StudentWriteControllerTest extends ZendControllerTestCase
{
    /**
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $services;

    /**
     * @var \Achievement\Student\Service\StudentRegisterInterface
     */
    protected $registerStudentService;

    /**
     * @var \Zend\Form\FormInterface
     */
    protected $studentForm;

    protected function setUp()
    {
        $this->setApplicationConfig(include "config/application.config.php");
        parent::setUp();

        $this->registerStudentService = $this->prophesize('Achievement\Student\Service\StudentRegisterInterface');
        $this->studentForm = $this->prophesize('Zend\Form\Form');
        $this->services = $this->getApplicationServiceLocator();
        $this->services->setAllowOverride(true);
        $this->services->setService('ams', $this->prophesize(Adapter::class)->reveal());
    }

    protected function submitStudentProfile(array $rawProfile = [])
    {
        $this->dispatch('/student/add', 'POST', $rawProfile);

        $this->assertMatchedRouteName('student/add');
        $this->assertModuleName('Achievement');
        $this->assertControllerName('Achievement\\Controller\\StudentWrite');
        $this->assertControllerClass('StudentWriteController');
        $this->assertActionName('add');
    }
   
    public function testWhenVisitPageCreateStudentProfileThenShowBlankStudentProfileForm()
    {
        $this->dispatch('/student/add');

        //assert match request
        $this->assertMatchedRouteName('student/add');
        $this->assertModuleName('Achievement');
        $this->assertControllerName('Achievement\\Controller\\StudentWrite');
        $this->assertControllerClass('StudentWriteController');
        $this->assertActionName('add');

        /**
         * assert blank form with needed element
         */
        $this->assertQuery("form[name='add-student'][id='add-student'][method='POST'][action='/student/add']");

        $this->assertQuery("input[name='student[registration-code]'][type='text'][maxlength='7']");
        $this->assertQuery("input[name='student[phonetic-name]'][type='text']");
        $this->assertQuery("input[name='student[fullname]'][type='text']");
        $this->assertQuery("input[name='student[dob]'][type='text']");

        $this->assertQuery("select[name='student[gender]']");
        $this->assertQuery("select[name='student[gender]'] > option[value='male']");
        $this->assertQuery("select[name='student[gender]'] > option[value='female']");

        $this->assertQuery("select[name='student[grade]']");
        $this->assertQuery("select[name='student[grade]'] > option[value='1']");
        $this->assertQuery("select[name='student[grade]'] > option[value='2']");
        $this->assertQuery("select[name='student[grade]'] > option[value='3']");

        $this->assertQuery("input[name='student[account][id]'][type='hidden']");
        $this->assertQuery("input[name='student[account][username]'][type='text'][maxlength='7']");
        $this->assertQuery("input[name='student[account][password]'][type='password']");

        //assert only one siblings fieldset exits
        $this->assertQuery("input[name='student[siblings][0][fullname]'][type='text']");
        $this->assertQuery("input[name='student[siblings][0][dob]'][type='text']");
        $this->assertQuery("input[name='student[siblings][0][work]'][type='text']");
        $this->assertQuery("select[name='student[siblings][0][relationship]']");
        $this->assertQuery("select[name='student[siblings][0][relationship]'] > option[value='sister']");
        $this->assertQuery("select[name='student[siblings][0][relationship]'] > option[value='brother']");

        //assert has 5 course
        $this->assertQuery("select[name='student[courses][0][code]']");
        $this->assertQuery("select[name='student[courses][1][code]']");
        $this->assertQuery("select[name='student[courses][2][code]']");
        $this->assertQuery("select[name='student[courses][3][code]']");
        $this->assertQuery("select[name='student[courses][4][code]']");
        $this->assertQuery("input[name='security'][type='hidden']");
        $this->assertQuery("button[name='add'][type='submit']");
    }

    public function testWhenRegisterStudentSuccessThenRedirectToPageListStudent()
    {
        $assumeValidStudent = [];
        $student = new Profile;

        $this->studentForm->setData(new Parameters($assumeValidStudent))->shouldBeCalled();
        $this->studentForm->isValid()->willReturn(true);
        $this->studentForm->getData()->willReturn($student);
        $this->registerStudentService->register($student)->shouldBeCalled();

        $this->services->setService(ProfileForm::class, $this->studentForm->reveal());
        $this->services->setService('RegisterStudentService', $this->registerStudentService->reveal());

        $this->submitStudentProfile($assumeValidStudent);
        $this->assertRedirectTo('/student');
    }
    
    public function testWhenSubmitEmptyStudentProfileThenRepresentStudentFormWithErrorMessage()
    {
        $this->submitStudentProfile();
        $this->assertQuery("form[name='add-student'][id='add-student'][method='POST'][action='/student/add']");
        $this->assertQuery(".has-error input[name='student[registration-code]'][type='text']");
        $this->assertQuery(".has-error input[name='student[phonetic-name]'][type='text']");
        $this->assertQuery(".has-error input[name='student[fullname]'][type='text']");
        $this->assertQuery(".has-error input[name='student[dob]'][type='text']");
        $this->assertQuery(".has-error select[name='student[gender]']");
        $this->assertQuery(".has-error input[name='student[account][username]'][type='text']");
        $this->assertQuery(".has-error input[name='student[account][password]'][type='password']");
    }
}
