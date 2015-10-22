<?php

namespace Achievement\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Form\FormInterface;

class StudentWriteController extends AbstractActionController
{
    /**
     * Student studentForm
     *
     * @var \Zend\Form\FormInterface
     */
    protected $studentForm;

    public function __construct(FormInterface $studentForm)
    {
        $this->studentForm = $studentForm;
    }

    public function indexAction()
    {
        return false;
    }

    public function addAction()
    {
        $request = $this->getRequest(); /* @var $request \Zend\Http\Request */

        if ($request->isPost()) {
            $this->studentForm->setData($request->getPost());
            if ($this->studentForm->isValid()) {
                //save student profile
                return $this->redirect()->toRoute('student');
            }
        }

        return [
            'studentForm' => $this->studentForm
        ];
    }
}
