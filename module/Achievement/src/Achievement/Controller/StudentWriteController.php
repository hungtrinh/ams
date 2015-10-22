<?php

namespace Achievement\Controller;

use Zend\Mvc\Controller\AbstractActionController;
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
        $request = $this->getRequest(); /* @var $request \Zend\Http\Request */

        if ($request->isPost()) {
            $this->form->setData($request->getPost());
            if ($this->form->isValid()) {
                //save student profile
                return $this->redirect()->toRoute('home');
            }
        }

        return [
            'form' => $this->form
        ];
    }
}
