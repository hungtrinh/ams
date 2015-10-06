<?php

namespace Achievement\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Form\FormInterface;

class StudentWriteController extends AbstractActionController
{
    /**
     * Student form
     *
     * @var \Zend\Form\FormInterface
     */
    protected $form;

    public function __construct(FormInterface $form)
    {
        $this->form = $form;
    }

    public function addAction()
    {
        return ['form' => $this->form];
    }
}
