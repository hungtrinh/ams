<?php

namespace AchievementTest\Student\Mapper;

use PHPUnit_Framework_TestCase as TestCase;
use AchievementTest\Bootstrap;
use Achievement\Student\Hydrator;
use Achievement\Student\Model\Sibling;

class SiblingsHydratorFunctionalTest extends TestCase
{
    /**
     * @var \Zend\StdClass\Hydrator\HydratorInterface
     */
    protected $siblingsHydrator;

    /**
     * @var \Achievement\Student\Model\ProfileInterface
     */
    protected $sibling;

    protected $expectedSiblingStruct = [
        'fullname' => 'Trinh Duc Hung',
        'dob' => '1985-01-18',
        'work' => 'Programmer',
        'relationship' => 'brother',
    ];

    protected function setUp()
    {
        parent::setUp();
        $services = Bootstrap::getServiceManager();
        $hydrators = $services->get('HydratorManager');
        $this->siblingsHydrator = $hydrators->get(Hydrator::SIBLINGS_HYDRATOR);
        $this->sibling = $this->factorySibling($this->expectedSiblingStruct);
    }

    protected function factorySibling($rawSibling)
    {
        $sibling = new Sibling();
        $sibling->setDob(\DateTime::createFromFormat('Y-m-d', $rawSibling['dob']));
        $sibling->setFullname($rawSibling['fullname'] ?: null);
        $sibling->setRelationship($rawSibling['relationship'] ?: null);
        $sibling->setWork($rawSibling['work'] ?: null);
        return $sibling;
    }

    public function testWhenCallExtractThenReturnSqlsiblingColumnStruct()
    {
        $rawSibling = $this->siblingsHydrator->extract($this->sibling);
        $this->assertEquals($this->expectedSiblingStruct, $rawSibling);
    }

    public function testWhenCallHydrateThenReturnProfileEntity()
    {
        $siblingPrototype = new Sibling();
        $siblingActual = $this->siblingsHydrator->hydrate($this->expectedSiblingStruct, $siblingPrototype);
        $this->assertEquals($this->sibling, $siblingActual);
        $this->assertEquals($this->sibling, $siblingPrototype);
    }
}
