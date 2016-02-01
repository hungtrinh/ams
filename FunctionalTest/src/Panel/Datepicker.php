<?php
namespace Ams\Panel;

use Ams\Page\PageAbstract;

/**
 * Boostrap datepicker
 * @link https://bootstrap-datepicker.readthedocs.org/en/latest/
 */
class Datepicker extends PageAbstract
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
}
