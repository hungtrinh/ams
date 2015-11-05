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

    public function __construct(
        FormInterface $studentForm,
        RegisterInterface $registerService
    ) {
        $this->studentForm     = $studentForm;
        $this->registerService = $registerService;
    }

    /**
     * @deprecated
     * list student will move to StudentViewController
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
        if ($this->requestShowFormStudent() ||
            $this->postInvalidProfile()) {
            return [
                'studentForm' => $this->studentForm,
            ];
        }

        $student = $this->studentForm->getData();
        $this->registerService->register($student);

        return $this->redirect()->toRoute('student');
    }

    /**
     * @return boolean
     */
    private function requestShowFormStudent()
    {
        return !$this->getRequest()->isPost();
    }

    /**
     * @return  boolean
     */
    private function postInvalidProfile()
    {
        $this->studentForm->setData($this->getRequest()->getPost());
        return !$this->studentForm->isValid();
    }
}
