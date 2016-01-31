<?php
namespace Ams\Page\Student;

use PHPUnit_Extensions_Selenium2TestCase as Selenium2TestCase;

class RegisterNewStudentTest extends Selenium2TestCase
{
    /**
     * @var \Ams\Page\Student\RegisterNewStudent
     */
    protected $page;

    protected $domain = 'http://127.0.0.1:8888';

    protected function setUp()
    {
        parent::setUp();
        $this->setBrowser("firefox");
        $this->setBrowserUrl($this->domain);
    }

    /**
     * @return \Ams\Page\Student\RegisterNewStudent
     */
    protected function visitPageRegisterStudent()
    {
        $this->url(RegisterNewStudent::URL);
        return new RegisterNewStudent($this);
    }

    public function testWhenVisitPageThenRegisterStudentPageAppearCorrect()
    {
        $registerStudentPage = $this->visitPageRegisterStudent();
        $registerStudentPage->assertFormAppearCorrect();
    }
}
