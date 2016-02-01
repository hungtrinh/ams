<?php
namespace Ams\Page\Student;

use PHPUnit_Extensions_Selenium2TestCase as Selenium2TestCase;
use Ams\Page\Home;

class RegisterNewStudentTest extends Selenium2TestCase
{
    /**
     * @var \Ams\Page\Student\RegisterNewStudent
     */
    protected $homepage;

    protected $domain = 'http://127.0.0.1:8888';

    protected function setUp()
    {
        parent::setUp();
        $this->setBrowser("firefox");
        $this->setBrowserUrl($this->domain);

        $this->homepage = new Home($this);
    }

    public function testGivenOnHomePageWhenVisitPageRegisterStudentThenFormRegisterAppearCorrect()
    {
        $registerStudentPage = $this->homepage->visitPageRegisterNewStudent();
        $registerStudentPage->assertFormAppearCorrect();
    }

    public function testGivenOnStudentRegisterPageWhenClickToDobThenCalendarDisplayed()
    {
        $registerStudentPage = $this->homepage->visitPageRegisterNewStudent();
        $calendarPanel = $registerStudentPage->clickToDobThenShowCalendar();
        $calendarPanel->assertDisplayed();
    }

    public function testGivenOnCalendarForDobWhenClickToDayThenDobFilledDateClicked()
    {
        $registerStudentPage = $this->homepage->visitPageRegisterNewStudent();
        $registerStudentPage->assertClickToDayOnCalendarWillFillDateToDob();
    }

    public function tesGivenOnStudentRegisterPageWhenClickToSiblingsDobThenCalendarDisplayed()
    {
        $registerStudentPage = $this->homepage->visitPageRegisterNewStudent();
        $calendarPanel = $registerStudentPage->clickToSiblingDobThenShowCalendar();
        $calendarPanel->assertDisplayed();
    }

    public function testGivenOnCalendarForSiblingsDobWhenClickDayThenSiblingsDobFilledDateClicked()
    {
        $registerStudentPage = $this->homepage->visitPageRegisterNewStudent();
        $registerStudentPage->assertClickToDayOnCalendarWillFillDateToSiblingDob();
    }
}
