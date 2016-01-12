<?php

namespace Achievement\Student\Form\Element;

use Zend\Form\FormElementManager;

class CourseSelectFactory
{
    public function __invoke(FormElementManager $formElements)
    {
        $select = $formElements->get('select');
        $expectedOptionValues = [
            '1' => '1',
            '2' => '2',
            '3' => '3',
        ];
        $select->setValueOptions($expectedOptionValues);
        return $select;
    }
}
