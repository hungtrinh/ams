<?php

namespace AchievementTest\Student\Form\Element;

use Achievement\Student\Form\Element\CourseSelectFactory;
use Zend\Form\Element\Select;
use Zend\Form\FormElementManager;
use PHPUnit_Framework_TestCase as TestCase;

class CourseSelectFactoryTest extends TestCase
{
    /**
     * @var \Achievement\Student\Form\Element\CourseSelectFactory
     */
    protected $factory;

    protected function setUp()
    {
        parent::setUp();
        $this->formElements = new FormElementManager;
        $this->factory      = new CourseSelectFactory;
    }

    public function testInvokeReturnZendFormElementSelect()
    {
        $factory = $this->factory;
        $this->isInstanceOf(Select::class, $factory($this->formElements));
    }
}
