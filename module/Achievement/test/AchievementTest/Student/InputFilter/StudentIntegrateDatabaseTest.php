<?php

namespace AchievementTest\Student\InputFilter;

use PHPUnit_Extensions_Database_TestCase_Trait;
use PHPUnit_Framework_TestCase as TestCase;
use AchievementTest\Bootstrap;
use AchievementTest\DbConnectionTrait;

/**
 * @group db
 */
class StudentIntegrateDatabaseTest extends TestCase
{
    use DbConnectionTrait;
    use PHPUnit_Extensions_Database_TestCase_Trait {
        PHPUnit_Extensions_Database_TestCase_Trait::setUp as dbSetup;
        PHPUnit_Extensions_Database_TestCase_Trait::setUp as dbTearDown;
    }
    
    
    /**
     * @var \Zend\InputFilter\InputFilterInterface
     */
    protected $studentInputFilter;

    protected function setUp() 
    {
        parent::setUp();
        $this->dbSetup();
        $serviceManager = Bootstrap::getServiceManager();
        $inputFilterManger = $serviceManager->get('InputFilterManager');
        $this->studentInputFilter = $inputFilterManger->get('Achievement\InputFilter\Student');
    }
    
    protected function tearDown() {
        $this->dbTearDown();
        parent::tearDown();
    }
    
    protected function getDataSet() {
        return $this->createArrayDataSet([
            'user' => [
                ['username'=>'hungtd1'],
                ['username'=>'binh1'],
            ]
        ]);
    }

    public function testTrue()
    {
        $this->assertTrue(true);
    }
}
