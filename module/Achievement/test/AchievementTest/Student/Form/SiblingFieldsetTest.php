<?php

namespace AchievementTest\Student\Form;

use PHPUnit_Framework_TestCase as TestCase;
use Achievement\Student\Form\SiblingFieldset;

class SiblingFieldsetTest extends TestCase
{
    /**
     * @var \Zend\Form\FieldsetInterface
     */
    protected $siblingFieldset;

    protected function setUp()
    {
        parent::setUp();
        $this->siblingFieldset = $this->getSiblingFieldsetFromServiceManager();
    }

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
    protected function getSiblingFieldsetFromServiceManager()
    {
        \AchievementTest\Bootstrap::init();
        $services = \AchievementTest\Bootstrap::getServiceManager();
        return $services->get(SiblingFieldset::class);
    }

    public function testCangetSiblingFieldsetFromServiceManagerBySiblingFieldsetClassName()
    {
        $this->assertInstanceOf(\Zend\Form\FieldsetInterface::class, $this->siblingFieldset);
    }

    public function testContainExpectedHydrator()
    {
        $hydrator = $this->siblingFieldset->getHydrator();
        $this->assertInstanceOf(\Zend\Hydrator\ClassMethods::class, $hydrator);
    }

    public function testHasObjectSibling()
    {
        $siblingModel = $this->siblingFieldset->getObject();
        $this->assertInstanceOf(\Achievement\Student\Model\Sibling::class, $siblingModel);
    }

    public function testWhenInjectValidSiblingCollectionThenGetDataReturnListSiblibModel()
    {
        $siblingRaw = [
            SiblingFieldset::FULLNAME     => 'trinh duc hung',
            SiblingFieldset::DOB          => '1985-18-01',
            SiblingFieldset::RELATIONSHIP => 'sister',
            SiblingFieldset::WORK         => 'Vnext software',
        ];
        $sibling = $this->siblingFieldset->bindValues($siblingRaw);
        $this->assertEquals('trinh duc hung', $sibling->getFullname());
    }
}
