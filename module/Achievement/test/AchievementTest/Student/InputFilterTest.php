<?php
namespace AchievementTest\Student;

use PHPUnit_Framework_TestCase as TestCase;
use Achievement\Student\InputFilter;
use AchievementTest\Bootstrap;

class InputFilterTest extends TestCase
{
    public function testHasConstStudentFormInputFilterSupportAccessInputFilterFromInputFilterManager()
    {
        $this->assertEquals('ProfileFormInputFilter', InputFilter::STUDENT_FORM_INPUT_FILTER);
    }
}
