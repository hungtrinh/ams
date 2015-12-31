<?php

namespace AchievementTest\Student\InputFilter;

use PHPUnit_Extensions_Database_TestCase as TestCase;
use AchievementTest\Bootstrap;
use AchievementTest\DbConnectionTrait;

/**
 * @group db
 */
class StudentIntegrateDatabaseTest extends TestCase
{
    use DbConnectionTrait;
    
    /**
     * @var \Zend\InputFilter\InputFilterInterface
     */
    protected $studentInputFilter;

    protected function setUp()
    {
        parent::setUp();
        $serviceManager = Bootstrap::getServiceManager();
        $inputFilterManger = $serviceManager->get('InputFilterManager');
        $this->studentInputFilter = $inputFilterManger->get('Achievement\InputFilter\Student');
    }
    
    protected function getDataSet()
    {
        return $this->createArrayDataSet([
            'user' => [
                ['username'=>'hungtd1'],
                ['username'=>'binh1'],
            ]
        ]);
    }

    public function testStoreHasTwoRecordPrepaired()
    {
        $this->assertEquals(2, $this->getConnection()->getRowCount('user'));
    }

    public function testStateOfTwoRecordPrepaired()
    {
        $queryTable = $this->getConnection()->createQueryTable('user', 'select username from user order by username desc');
        $expectedTable = $this->createArrayDataSet([
            'user' => [
                ['username'=>'hungtd1'],
                ['username'=>'binh1'],
            ]
        ])->getTable('user');
        $this->assertTablesEqual($expectedTable, $queryTable);
    }
}
