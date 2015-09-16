<?php

namespace AchievementTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase as ZendControllerTestCase;

abstract class AbstractHttpControllerTestCase extends ZendControllerTestCase
{
    public function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__.'/../../../../../config/application.config.php'
        );
        parent::setUp();
    }
}
