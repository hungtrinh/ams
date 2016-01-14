<?php

namespace AchievementTest\Student\Form;

use PHPUnit_Framework_TestCase as TestCase;
use Achievement\Student\Form\Element;

class ElementTest extends TestCase
{
    public function testHasConstCourseSelectSupportGetElementCourseSelectFromFromElementManager()
    {
        $this->assertEquals('courseselect', Element::COURSE_SELECT);
    }
}
