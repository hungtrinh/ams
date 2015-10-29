<?php

namespace Achievement\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Form\FormInterface;
use Achievement\Student\Service\RegisterInterface;

class StudentWriteController extends AbstractActionController
{
    /**
     * Student studentForm
     *
     * @var \Zend\Form\FormInterface
     */
    protected $studentForm;

    /**
     *
     * @var \Achievement\Student\Service\RegisterInterface;
     */
    protected $registerService;

    public function __construct(FormInterface $studentForm, RegisterInterface $registerService)
    {
        $this->studentForm = $studentForm;
        $this->registerService = $registerService;
    }

    /**
     * list student
     */
    public function indexAction()
    {
        return false;
    }

    /**
     * Display new student form when user visit
     * Persit student to persitent when user submit form and redirect to list student page
     */
    public function addAction()
    {
        $request         = $this->getRequest(); /* @var $request \Zend\Http\Request */
        $requestShowForm = $request->isGet();
        $displayForm     = [
            'studentForm' => $this->studentForm,
        ];

        if ($requestShowForm) {
            return $displayForm;
        }

        //User request save student
        $this->studentForm->setData($request->getPost());
        $invalidStudentData = !$this->studentForm->isValid();
        if ($invalidStudentData) {
            return $displayForm;
        }

        //@todo Persit student to database.
         $student = $this->studentForm->getData();
         $this->registerService->register($student);

        return $this->redirect()->toRoute('student');
    }
}
