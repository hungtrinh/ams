<?php
namespace Ams\Panel;

use Ams\Page\PageAbstract;
use PHPUnit_Extensions_Selenium2TestCase as Selenium2TestCase;
use PHPUnit_Extensions_Selenium2TestCase_Keys as Keys;
use PHPUnit_Extensions_Selenium2TestCase_WebDriverException as WebDriverException;

/**
 * Dynamic sibling fieldset created when user interactive on ui
 */
class SiblingFieldset extends PageAbstract
{
    /**
     * Array index idicate input order on UI
     * @var integer
     */
    protected $siblingIndex = 0;

    /**
     * @var \PHPUnit_Extensions_Selenium2TestCase_Element
     */
    protected $fullnameInput;

    /**
     * @var \PHPUnit_Extensions_Selenium2TestCase_Element
     */
    protected $dobInput;

    /**
     * @var \PHPUnit_Extensions_Selenium2TestCase_Element
     */
    protected $relationshipSelect;

    /**
     * @var \PHPUnit_Extensions_Selenium2TestCase_Element
     */
    protected $workInput;

    /**
     * @param Selenium2TestCase $testCase
     * @param integer           $siblingIndex array index, start 0 (has 3 sibling => max index = 2)
     */
    public function __construct(Selenium2TestCase $testCase, $siblingIndex = 0)
    {
        $this->siblingIndex = $siblingIndex;
        parent::__construct($testCase);
    }

    protected function initElements()
    {
        $i = $this->siblingIndex;
        $testCase = $this->testCase;

        $this->fullnameInput        = $testCase->byName("student[siblings][$i][fullname]");
        $this->dobInput             = $testCase->byName("student[siblings][$i][dob]");
        $this->workInput            = $testCase->byName("student[siblings][$i][work]");
        $this->relationshipSelect   = $testCase->byName("student[siblings][$i][relationship]");
    }

    /**
     * @return callable
     */
    protected function siblingFieldsetCreated()
    {
        $i = $this->siblingIndex + 1;
        return function ($testCase) use ($i) {
            try {
                $testCase->byCssSelector("student[siblings][$i][fullname]");
                return true;
            } catch (WebDriverException $e) {
            }
            return false;
        };
    }

    /**
     * press tab key on work input
     * @return \Ams\Panel\SiblingFieldset
     */
    public function pressTabKeyOnWorkInput()
    {
        $this->workInput->click();
        $this->testCase->keys(Keys::TAB);
        $this->testCase->waitUntil($this->siblingFieldsetCreated(), 500);
        return new SiblingFieldset($this->testCase, $this->siblingIndex+1);
    }
}
