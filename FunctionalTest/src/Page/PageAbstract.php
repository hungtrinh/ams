<?php

namespace Ams\Page;

use PHPUnit_Extensions_Selenium2TestCase as Selenium2TestCase;

abstract class PageAbstract
{
    /**
     * @var \PHPUnit_Extensions_Selenium2TestCase
     */
    protected $testCase;

    public function __construct(Selenium2TestCase $testCase)
    {
        $this->testCase = $testCase;
        $this->initElements();
    }

    /**
     * assume page loaded, locate all element on current page(panel)
     */
    abstract protected function initElements();

    /**
     * Get page title
     * @return string page title
     */
    public function title()
    {
        return $this->testCase->title();
    }
}
