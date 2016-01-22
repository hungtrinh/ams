<?php

namespace AchievementTest\Student\Form;

use PHPUnit_Framework_TestCase as TestCase;
use Achievement\Student\Form\SiblingFieldset;

class SiblingFieldsetTest extends TestCase
{
    /**
     * @test
     * @return boolean [description]
     */
    public function hasConstSupportDirectAccessFullnameElement()
    {
        $this->assertEquals('fullname', SiblingFieldset::FULLNAME);
    }

    public function hasConstSupportDirectAccessDateOfBirthElement()
    {
        $this->assertEquals('dob', SiblingFieldset::DOB);
    }

    public function hasConstSupportDirectAccessRelationshipElement()
    {
        $this->assertEquals('relationship', SiblingFieldset::RELATIONSHIP);
    }

    public function hasConstSupportDirectAccessWorkElement()
    {
        $this->assertEquals('work', SiblingFieldset::WORK);
    }

    public function testCanGetSiblingFieldsetBySiblingFieldsetClassName()
    {
        $services = \AchievementTest\Bootstrap::getServiceManager();
        $siblingFieldset = $services->get(SiblingFieldset::class);

        $this->assertInstanceOf(\Zend\Form\FieldsetInterface::class, $siblingFieldset);
    }
}
