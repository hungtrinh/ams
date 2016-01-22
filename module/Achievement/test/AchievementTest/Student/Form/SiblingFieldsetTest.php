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

    /**
     * @return \Zend\Form\FieldsetInterface::class
     */
    protected function createSiblingFieldset()
    {
        \AchievementTest\Bootstrap::init();
        $services = \AchievementTest\Bootstrap::getServiceManager();
        return $services->get(SiblingFieldset::class);
    }

    public function testCancreateSiblingFieldsetBySiblingFieldsetClassName()
    {
        $this->assertInstanceOf(\Zend\Form\FieldsetInterface::class, $this->createSiblingFieldset());
    }

    public function testWhenInjectValidSiblingCollectionThenGetDataReturnListSiblibModel()
    {
        $siblingFieldset = $this->createSiblingFieldset();
        $siblingFieldset->populateValues([
            SiblingFieldset::FULLNAME     => 'trinh duc hung',
            SiblingFieldset::DOB          => '1985-18-01',
            SiblingFieldset::RELATIONSHIP => 'sister',
            SiblingFieldset::WORK         => 'Vnext software',
        ]);

        /**
         * @var $sibling \Achievement\Student\Model\Sibling
         */
        $sibling = $siblingFieldset->getObject();
        $this->assertEquals('trinh duc hung', $sibling->getFullname());
    }
}
