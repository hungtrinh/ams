<?php

namespace Achievement\Student\Form\Element;

use Zend\Form\FormElementManager;

/**
 * Create an Zend\Form\Element\Select instance
 * prepaire list all course get from persistent
 */
class CourseSelectFactory
{
    /**
     * @param  FormElementManager $formElements
     * @return \Zend\Form\Element\Select
     */
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
