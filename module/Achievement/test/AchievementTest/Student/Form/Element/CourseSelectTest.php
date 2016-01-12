<?php

namespace AchievementTest\Student\Form\Element;

use Achievement\Student\Form\Element\CourseSelectFactory;
use Achievement\Student\Form\Element;
use Zend\Form\FormElementManager;
use PHPUnit_Framework_TestCase as TestCase;
use AchievementTest\Bootstrap;

class CourseSelectTest extends TestCase
{
    /**
     * @var \Zend\Form\Element\Select
     */
    protected $courseSelect;

    protected function setUp()
    {
        parent::setUp();
        Bootstrap::init();
        $services = Bootstrap::getServiceManager();
        $formElements = $services->get('FormElementManager');
        $this->courseSelect = $formElements->get(Element::COURSE_SELECT);
    }

    public function testGetValueOptionsWillReturnExpectedValues()
    {
        $optionValues = $this->courseSelect->getValueOptions();
        $expectedOptionValues = [
            '1' => '1',
            '2' => '2',
            '3' => '3',
        ];
        $this->assertEquals($expectedOptionValues, $optionValues);
    }
}
