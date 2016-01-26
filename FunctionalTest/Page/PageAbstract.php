<?php

namespace Ams\Page;

use PHPUnit_Extensions_Selenium2TestCase as Selenium2TestCase;

abstract class PageAbstract
{
    /**
     * @var \PHPUnit_Extensions_Selenium2TestCase
     */
    protected $webdriver;

    public function __construct(Selenium2TestCase $webdriver)
    {
        $this->webdriver = $webdriver;
    }
}
