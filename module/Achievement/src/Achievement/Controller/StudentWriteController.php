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

    /**
     * list student
     */
    public function indexAction()
    {
        return false;
    }

    /**
     * Display new student form.
     */
    public function addAction()
    {
        return [
            'studentForm' => $this->studentForm
        ];
    }

    /**
     * Persit valid student to db and redirect to list student page.
     */
    public function saveAction()
    {
        $request = $this->getRequest(); /* @var $request \Zend\Http\Request */
        if (!$request->isPost()) {
            return $this->forward()->dispatch('Achievement\Controller\StudentWrite', ['action' => 'add']);
        }

        $this->studentForm->setData($request->getPost());
        if (!$this->studentForm->isValid()) {
            return $this->forward()->dispatch('Achievement\Controller\StudentWrite', ['action' => 'add']);
        }

        //@todo Persit student to database.
        // $student = $this->studentForm->getData();

        return $this->redirect()->toRoute('student');
    }
}
