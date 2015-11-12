<?php

namespace AchievementTest\InputFilter;

use PHPUnit_Framework_TestCase as TestCase;
use AchievementTest\Bootstrap;
use Zend\InputFilter\InputFilterInterface;

class StudentTest extends TestCase
{
    /**
     * @var \Zend\InputFilter\InputFilterInterface
     */
    protected $studentInputFilter;

    protected function setUp()
    {
        $this->studentInputFilter = Bootstrap::getServiceManager()
                                        ->get('InputFilterManager')
                                        ->get('Achievement\InputFilter\Student');
    }

    public function testIsAnInstanceInputFilterInterface()
    {
        $this->assertInstanceOf(InputFilterInterface::class, $this->studentInputFilter);
    }

    public function testWhenCallIsValidWithValidProfileThenReturnTrue()
    {

        $validProfile = include(realpath("module/Achievement/test/AchievementTest/_fixtures/validStudentProfile.php"));
        $this->assertTrue($this->studentInputFilter->setData($validProfile)->isValid());
    }
}
