<?php
namespace Ams\Panel;

use Ams\Page\PageAbstract;

/**
 * Boostrap datepicker
 * @link https://bootstrap-datepicker.readthedocs.org/en/latest/
 */
class BootstrapDatepicker extends PageAbstract
{
    protected function initElements()
    {
        $this->calendar = $this->testCase->byCssSelector('.datepicker');
    }

    public function chooseDayInCurrentMonth($dayNumber = 15)
    {
        $day = $this->testCase->byXpath("//td[@class='day' and text()=$dayNumber]");
        $day->click();
    }

    /**
     * @return boolean
     */
    public function displayed()
    {
        return $this->calendar->displayed();
    }

    public function assertDisplayed()
    {
        $this->testCase->assertTrue($this->displayed());
    }
}
