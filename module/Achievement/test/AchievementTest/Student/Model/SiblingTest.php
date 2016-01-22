<?php

namespace AchievementTest\Student\Model;

use PHPUnit_Framework_TestCase as TestCase;
use Achievement\Student\Model\Sibling;
use Achievement\Student\Model\InvalidArgumentException;
use DateTime;

class SiblingTest extends TestCase
{

    public function testThrowExceptionWhenDobDifferentNullOrDateTimeObject()
    {
        $this->setExpectedException(InvalidArgumentException::class);
        $sibling = new Sibling();
        $sibling->setDob('');
    }

    public function testWhenGetDobThenReturnNullIfNotSetterDob()
    {
        $sibling = new Sibling();
        $this->assertNull($sibling->getDob());
    }

    public function testWhenSetDobDateTimeThenCallGetDobWillReturnInfoSetted()
    {
        $dob = DateTime::createFromFormat('Y-m-d', '2015-11-02');
        $sibling = new Sibling();
        $sibling->setDob($dob);

        $this->assertSame($dob, $sibling->getDob());
    }
}
