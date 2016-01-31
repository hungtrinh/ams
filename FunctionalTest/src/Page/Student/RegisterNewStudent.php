<?php

namespace Ams\Page\Student;

use Ams\Page\PageAbstract;

class RegisterNewStudent extends PageAbstract
{
    const URL = '/student/add';

    protected function initElements()
    {
        $this->registrationCodeInput = $this->webdriver->byName('student[registration-code]');
        $this->phoneticNameInput = $this->webdriver->byName('student[phonetic-name]');
        $this->fullnameInput = $this->webdriver->byName('student[fullname]');
        $this->dobInput = $this->webdriver->byName('student[dob]');
        $this->accountIdInput= $this->webdriver->byName('student[account][id]');
        $this->accountUsernameInput= $this->webdriver->byName('student[account][username]');
        $this->accountPasswordInput= $this->webdriver->byName('student[account][password]');

        $this->fistSiblingFullnameInput= $this->webdriver->byName('student[siblings][0][fullname]');
        $this->fistSiblingDobInput= $this->webdriver->byName('student[siblings][0][dob]');
        $this->fistSiblingWorkInput= $this->webdriver->byName('student[siblings][0][work]');
        $this->fistSiblingRelationshipSelect= $this->webdriver->byName('student[siblings][0][relationship]');

        $this->firstCourseSelect= $this->webdriver->byName('student[courses][0][code]');
        $this->secondCourseSelect= $this->webdriver->byName('student[courses][1][code]');
        $this->threethCourseSelect= $this->webdriver->byName('student[courses][2][code]');
        $this->fourthCourseSelect= $this->webdriver->byName('student[courses][3][code]');
        $this->fivethCourseSelect= $this->webdriver->byName('student[courses][4][code]');

        $this->submitButton = $this->webdriver->byName('add');
    }

    public function assertFormAppearCorrect()
    {
        $this->webdriver->assertContains('Register student', $this->webdriver->title());

        $this->webdriver->assertEmpty($this->registrationCodeInput->value());
        $this->webdriver->assertEmpty($this->phoneticNameInput->value());
        $this->webdriver->assertEmpty($this->fullnameInput->value());
        $this->webdriver->assertEmpty($this->dobInput->value());
        $this->webdriver->assertEmpty($this->accountIdInput->value());
        $this->webdriver->assertEmpty($this->accountUsernameInput->value());
        $this->webdriver->assertEmpty($this->accountPasswordInput->value());

        $this->webdriver->assertEmpty($this->fistSiblingFullnameInput->value());
        $this->webdriver->assertEmpty($this->fistSiblingDobInput->value());
        $this->webdriver->assertEmpty($this->fistSiblingWorkInput->value());
        $this->webdriver->assertEquals('sister', $this->fistSiblingRelationshipSelect->value());
    }
}
