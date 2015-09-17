<?php

namespace AchievementTest\Controller;

class StudentWriteControllerTest extends AbstractHttpControllerTestCase
{
    public function testWhenVisitPageCreateStudentProfileThenShowBlankStudentProfileForm()
    {
        $this->dispatch('/student/add');

        //assert match request
        $this->assertMatchedRouteName('student/add');
        $this->assertModuleName('Achievement');
        $this->assertControllerName('achievement\\Controller\\StudentWrite');
        $this->assertControllerClass('StudentWriteController');
        $this->assertActionName('add');

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
