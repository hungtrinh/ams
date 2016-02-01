<?php

namespace Ams\Page;

use Ams\Page\PageAbstract;
use Ams\Page\Student\RegisterNewStudent;

class Home extends PageAbstract
{
    protected function initElements()
    {
    }

    /**
     * @return \Ams\Page\Student\RegisterNewStudent
     */
    public function visitPageRegisterNewStudent()
    {
        $this->testCase->url(RegisterNewStudent::URL);
        return new RegisterNewStudent($this->testCase);
    }
}
