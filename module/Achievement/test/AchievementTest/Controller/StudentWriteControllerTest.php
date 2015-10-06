<?php

namespace AchievementTest\Controller;

class StudentWriteControllerTest extends AbstractHttpControllerTestCase
{
    protected $traceError = true;

    public function testWhenVisitPageCreateStudentProfileThenShowBlankStudentProfileForm()
    {
        $this->dispatch('/student/add');

        //assert match request
        $this->assertMatchedRouteName('student/add');
        $this->assertModuleName('Achievement');
        $this->assertControllerName('achievement\\Controller\\StudentWrite');
        $this->assertControllerClass('StudentWriteController');
        $this->assertActionName('add');

        // turn on this line to debug
        // echo $this->getResponse()->getContent();

        /**
         * assert blank form with needed element
         */
        $this->assertQuery("form[name='add-student'][id='add-student'][method='POST'][action='/student/add']");

        $this->assertQuery("input[name='student[registration-code]'][type='text']");
        $this->assertQuery("input[name='student[katakana-name]'][type='text']");
        $this->assertQuery("input[name='student[fullname]'][type='text']");
        $this->assertQuery("input[name='student[dob]'][type='text']");
        $this->assertQuery("select[name='student[gender]']");
        $this->assertQuery("select[name='student[school-year]']");

        $this->assertQuery("input[name='student[account][id]'][type='hidden']");
        $this->assertQuery("input[name='student[account][username]'][type='text']");
        $this->assertQuery("input[name='student[account][password]'][type='password']");

        //assert only one siblings fieldset exits
        $this->assertQuery("input[name='student[siblings][0][fullname]'][type='text']");
        $this->assertQuery("input[name='student[siblings][0][dob]'][type='text']");
        $this->assertQuery("input[name='student[siblings][0][work]'][type='text']");
        $this->assertQuery("select[name='student[siblings][0][relationship]']");
        $this->assertQuery("select[name='student[siblings][0][relationship]'] > option[value='sister']");
        $this->assertQuery("select[name='student[siblings][0][relationship]'] > option[value='brother']");

        $this->assertQuery("input[name='add'][type='submit']");


    }

    public function testWhenCreatedStudentProfileSuccessThenRedirectToPageListStudent()
    {
        $this->markTestIncomplete('specification');
    }

    public function testWhenVisitPageEditStudentProfileThenShowPopulatedStudentProfileForm()
    {
        $this->markTestIncomplete('specification');
    }

    public function testWhenUpdatedStudentProfileSuccessThenRedirectToPageListStudent()
    {
        $this->markTestIncomplete('specification');
    }
}
