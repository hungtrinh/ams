<?php

namespace AchievementTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase as ZendControllerTestCase;
use AchievementTest\DbConnectionTrait;
use PHPUnit_Extensions_Database_TestCase_Trait;

abstract class AbstractHttpControllerTestCase extends ZendControllerTestCase
{
    use DbConnectionTrait;
    use PHPUnit_Extensions_Database_TestCase_Trait {
        setUp as setUpDatbase;
        tearDown as tearDownDatabase;
    }
    
    protected function setUp()
    {
        $this->setApplicationConfig(
            include './config/application.config.php'
        );

        parent::setUp();
        
        $this->setUpDatbase();
        $this->setupAmsDbAdapter();
    }

    protected function setupAmsDbAdapter()
    {
        $services = $this->getApplicationServiceLocator();
        $services->setAllowOverride(true);
        $services->setService('ams', $this->getDbAdapter());
    }
    
    protected function tearDown()
    {
        $this->tearDownDatabase();
        parent::tearDown();
    }
}
