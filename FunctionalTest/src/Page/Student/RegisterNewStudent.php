<?php

namespace Ams\Page\Student;

use Ams\Page\PageAbstract;
use Ams\Panel\Datepicker;

class RegisterNewStudent extends PageAbstract
{
    const URL = '/student/add';

    protected function initElements()
    {
        $testCase = $this->testCase;

        $this->registrationCodeInput = $testCase->byName('student[registration-code]');
        $this->phoneticNameInput = $testCase->byName('student[phonetic-name]');
        $this->fullnameInput = $testCase->byName('student[fullname]');
        $this->dobInput = $testCase->byName('student[dob]');
        $this->genderSelect = $testCase->byName('student[gender]');
        $this->gradeSelect = $testCase->byName('student[grade]');

        $this->accountIdInput= $testCase->byName('student[account][id]');
        $this->accountUsernameInput= $testCase->byName('student[account][username]');
        $this->accountPasswordInput= $testCase->byName('student[account][password]');

        $this->fistSiblingFullnameInput= $testCase->byName('student[siblings][0][fullname]');
        $this->fistSiblingDobInput= $testCase->byName('student[siblings][0][dob]');
        $this->fistSiblingWorkInput= $testCase->byName('student[siblings][0][work]');
        $this->fistSiblingRelationshipSelect= $testCase->byName('student[siblings][0][relationship]');

        $this->firstCourseSelect= $testCase->byName('student[courses][0][code]');
        $this->secondCourseSelect= $testCase->byName('student[courses][1][code]');
        $this->threethCourseSelect= $testCase->byName('student[courses][2][code]');
        $this->fourthCourseSelect= $testCase->byName('student[courses][3][code]');
        $this->fivethCourseSelect= $testCase->byName('student[courses][4][code]');

        $this->submitButton = $testCase->byName('add');
    }

    /**
     * [assertFormAppearCorrect description]
     * @return void
     */
    public function assertFormAppearCorrect()
    {
        $testCase = $this->testCase;
        $testCase->assertContains('Register student', $testCase->title());

        $testCase->assertEmpty($this->registrationCodeInput->value());
        $testCase->assertEmpty($this->phoneticNameInput->value());
        $testCase->assertEmpty($this->fullnameInput->value());
        $testCase->assertEmpty($this->dobInput->value());
        $maleCode = 'male';
        $testCase->assertEquals($maleCode, $this->genderSelect->value());
        $gradeCode = 1;
        $testCase->assertEquals($gradeCode, $this->gradeSelect->value());
        
        $testCase->assertEmpty($this->accountIdInput->value());
        $testCase->assertEmpty($this->accountUsernameInput->value());
        $testCase->assertEmpty($this->accountPasswordInput->value());

        $testCase->assertEmpty($this->fistSiblingFullnameInput->value());
        $testCase->assertEmpty($this->fistSiblingDobInput->value());
        $testCase->assertEmpty($this->fistSiblingWorkInput->value());
        $testCase->assertEquals('sister', $this->fistSiblingRelationshipSelect->value());

        $initCourseId = 1;
        $testCase->assertEquals($initCourseId, $this->firstCourseSelect->value());
        $testCase->assertEquals($initCourseId, $this->secondCourseSelect->value());
        $testCase->assertEquals($initCourseId, $this->threethCourseSelect->value());
        $testCase->assertEquals($initCourseId, $this->fourthCourseSelect->value());
        $testCase->assertEquals($initCourseId, $this->fivethCourseSelect->value());
        $testCase->assertEquals('Add new', $this->submitButton->value());
    }

    /**
     * @return \Ams\Panel\Datepicker
     */
    public function clickToDobThenShowCalendar()
    {
        $calendarDisplay = function ($testCase) {
            if ($testCase->byCssSelector('.datepicker')->displayed()) {
                return true;
            }
            return null;
        };

        $this->dobInput->click();
        $this->testCase->waitUntil($calendarDisplay, 500);
        return new Datepicker($this->testCase);
    }

    /**
     * @return \Ams\Panel\Datepicker
     */
    public function clickToSiblingDobThenShowCalendar()
    {
        $calendarDisplay = function ($testCase) {
            if ($testCase->byCssSelector('.datepicker')->displayed()) {
                return true;
            }
            return null;
        };

        $this->fistSiblingDobInput->click();
        $this->testCase->waitUntil($calendarDisplay, 500);
        return new Datepicker($this->testCase);
    }

    /**
     * @return void
     */
    public function assertClickToDayOnCalendarWillFillDateToDob()
    {
        $fifteen = date('m/15/Y');
        $datepicker = $this->clickToDobThenShowCalendar();
        $datepicker->chooseDayInCurrentMonth(15);

        $this->testCase->assertEquals($fifteen, $this->dobInput->value());
    }

    /**
     * @return void
     */
    public function assertClickToDayOnCalendarWillFillDateToSiblingDob()
    {
        $fifteen = date('m/15/Y');
        $datepicker = $this->clickToSiblingDobThenShowCalendar();
        $datepicker->chooseDayInCurrentMonth(15);

        $this->testCase->assertEquals($fifteen, $this->fistSiblingDobInput->value());
    }
}
