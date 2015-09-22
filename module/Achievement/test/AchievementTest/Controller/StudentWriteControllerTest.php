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
        $this->assertQuery("input[type='text'][name='student[registration-code]']");
        $this->assertQuery("input[type='text'][name='student[katakana-name]']");
        $this->assertQuery("input[type='text'][name='student[fullname]']");
        $this->assertQuery("input[type='text'][name='student[dob]']");
        $this->assertQuery("select[name='student[gender]']");
        $this->assertQuery("select[name='student[school-year]']");

        //assert only one siblings fieldset exits
        $this->assertQuery("input[type='text'][name='student[siblings][0][fullname]']");
        $this->assertQuery("input[type='text'][name='student[siblings][0][dob]']");
        $this->assertQuery("input[type='text'][name='student[siblings][0][work]']");
        $this->assertQuery("select[name='student[siblings][0][relationship]']");
        $this->assertQuery("select[name='student[siblings][0][relationship]'] > option[value='sister']");
        $this->assertQuery("select[name='student[siblings][0][relationship]'] > option[value='brother']");
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
