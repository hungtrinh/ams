<?php

namespace AchievementTest\Controller;

class StudentWriteControllerTest extends AbstractHttpControllerTestCase
{
    protected $profileValid = [
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

    protected $mockRegisterStudentService;

    public function setUp()
    {
        parent::setUp();

        $this->mockRegisterStudentService = $this->prophesize('Achievement\Student\Service\Register')->reveal();
        $serviceLocator = $this->getApplicationServiceLocator();
        $serviceLocator->setAllowOverride(true);
        $serviceLocator->setService('RegisterStudentService', $this->mockRegisterStudentService);
    }




    public function validNewStudentProfileProvider()
    {
        $newProfile = $this->profileValid;
        unset($newProfile['student']['account']['id']);

        return [
            [$newProfile],
        ];
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

        // comment out line below to see html debug response
        // echo $this->getResponse()->getContent();

        /**
         * assert blank form with needed element
         */
        $this->assertQuery("form[name='add-student'][id='add-student'][method='POST'][action='/student/add']");

        $this->assertQuery("input[name='student[registration-code]'][type='text'][maxlength='7']");
        $this->assertQuery("input[name='student[katakana-name]'][type='text']");
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

    protected function submitStudentProfile(array $rawProfile = [])
    {
        $locator     = $this->getApplicationServiceLocator();
        $formStudent = $locator->get('Form\Student');
        $security    = $formStudent->get('security');
        $rawProfile['security'] = $security->getValue();


        $this->dispatch('/student/add', 'POST', $rawProfile);

        $this->assertMatchedRouteName('student/add');
        $this->assertModuleName('Achievement');
        $this->assertControllerName('Achievement\\Controller\\StudentWrite');
        $this->assertControllerClass('StudentWriteController');
        $this->assertActionName('add');
    }

    public function testWhenSubmitEmptyStudentProfileThenSystemDisplayRegistrationCodeErrorMessage()
    {
        $this->submitStudentProfile();
        $this->assertQuery(".has-error input[name='student[registration-code]'][type='text']");
    }

    public function testWhenSubmitEmptyStudentProfileThenSystemDisplayKatakanaNameErrorMessage()
    {
        $this->submitStudentProfile();
        $this->assertQuery(".has-error input[name='student[katakana-name]'][type='text']");
    }

    public function testWhenSubmitEmptyStudentProfileThenSystemDisplayFullnameErrorMessage()
    {
        $this->submitStudentProfile();
        $this->assertQuery(".has-error input[name='student[fullname]'][type='text']");
    }

    public function testWhenSubmitEmptyStudentProfileThenSystemDisplayBirthdayErrorMessage()
    {
        $this->submitStudentProfile();
        $this->assertQuery(".has-error input[name='student[dob]'][type='text']");
    }

    public function testWhenSubmitEmptyStudentProfileThenSystemDisplayGenderErrorMessage()
    {
        $this->submitStudentProfile();
        $this->assertQuery(".has-error select[name='student[gender]']");
    }

    public function testWhenSubmitEmptyStudentProfileThenSystemDisplayGradeErrorMessage()
    {
        $this->submitStudentProfile();
        $this->assertQuery(".has-error select[name='student[grade]']");
    }

    public function testWhenSubmitEmptyStudentProfileThenSystemDisplayUsernameErrorMessage()
    {
        $this->submitStudentProfile();
        $this->assertQuery(".has-error input[name='student[account][username]'][type='text']");
    }

    public function testWhenSubmitEmptyStudentProfileThenSystemDisplayPasswordErrorMessage()
    {
        $this->submitStudentProfile();
        $this->assertQuery(".has-error input[name='student[account][password]'][type='password']");
    }

    /**
     * @dataProvider validNewStudentProfileProvider
     */
    public function testWhenCreatedStudentProfileSuccessThenRedirectToPageListStudent($validProfile)
    {
        $this->mockRegisterStudentService
                ->register($validProfile);

        $this->submitStudentProfile($validProfile);

        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/student');
    }


    public function testWhenVisitListStudentPageThenMatchStudentRoute()
    {
        $this->dispatch('/student');

        //assert match request
        $this->assertMatchedRouteName('student');
        $this->assertModuleName('Achievement');
        $this->assertControllerName('Achievement\\Controller\\StudentWrite');
        $this->assertControllerClass('StudentWriteController');
        $this->assertActionName('index');
    }
}
