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
        $registerStudentPage = $this->homepage->gotoRegisterStudentPage();
        $registerStudentPage->assertFormAppearCorrect();
    }

    public function testGivenOnStudentRegisterPageWhenClickToDobThenCalendarDisplayed()
    {
        $registerStudentPage = $this->homepage->gotoRegisterStudentPage();
        $calendarPanel = $registerStudentPage->clickToDobThenShowCalendar();
        $calendarPanel->assertDisplayed();
    }

    public function testGivenOnCalendarForDobWhenClickToDayThenFillDateClicked2Dob()
    {
        $registerStudentPage = $this->homepage->gotoRegisterStudentPage();
        $registerStudentPage->assertClickToDayOnCalendarWillFillDateToDob();
    }

    public function testGivenOnStudentRegisterPageWhenClickToSiblingsDobThenCalendarDisplayed()
    {
        $registerStudentPage = $this->homepage->gotoRegisterStudentPage();
        $calendarPanel = $registerStudentPage->clickToSiblingDobThenShowCalendar();
        $calendarPanel->assertDisplayed();
    }

    public function testGivenOnCalendarForSiblingsDobWhenClickDayThenFillDateClicked2SiblingsDob()
    {
        $registerStudentPage = $this->homepage->gotoRegisterStudentPage();
        $registerStudentPage->assertClickToDayOnCalendarWillFillDateToSiblingDob();
    }

    public function testGivenOnStudentRegisterPageWhenTabOnSiblingWorkInputThenCreateNewSiblingFieldsetMax3()
    {
        $registerStudentPage = $this->homepage->gotoRegisterStudentPage();
        $registerStudentPage->assertOnSiblingWorkPressTabThenCreateMaximum3SiblingInput();
    }
}
