<?php

namespace Achievement\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Form\FormInterface;
use Achievement\Student\Service\StudentRegisterInterface;

class StudentWriteController extends AbstractActionController
{
    /**
     * Student form
     * @var \Zend\Form\FormInterface
     */
    protected $studentForm;

    /**
     * Student register service
     * @var \Achievement\Student\Service\StudentRegisterInterface;
     */
    protected $registerService;

    /**
     * Initial neeeded resource to register an student
     * @param FormInterface     $studentForm     student form user will see
     * @param StudentRegisterInterface $registerService register student service
     */
    public function __construct(
        FormInterface $studentForm,
        StudentRegisterInterface $registerService
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
     * 1.Display new student form when user visit
     * 2.Persit student to persitent when user submit form
     * and redirect to list student page
     */
    public function addAction()
    {
        if ($this->requestShowFormStudent() ||
            $this->postInvalidProfile()) {
            return [
                'studentForm' => $this->studentForm,
            ];
        }

        $studentValid = $this->studentForm->getData();
        $this->registerService->register($studentValid);

        return $this->redirect()->toRoute('student');
    }

    /**
     * Assert user want to see student form only
     * @return boolean
     */
    private function requestShowFormStudent()
    {
        return !$this->getRequest()->isPost();
    }

    /**
     * Assert user post raw valid profile data
     * @return  boolean
     */
    private function postInvalidProfile()
    {
        $this->studentForm->setData($this->getRequest()->getPost());
        return !$this->studentForm->isValid();
    }
}
