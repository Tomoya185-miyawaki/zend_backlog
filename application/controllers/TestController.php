<?php

class TestController extends Zend_Controller_Action
{

    public function init()
    {
        $this->test = new Application_Model_DbTable_Tests();
        $this->form = new Application_Form_Test();
    }

    public function indexAction()
    {
        $this->view->tests = $this->test->fetchAll();
    }

    public function addAction()
    {
        $this->form->submit->setLabel('Add');
        $this->view->form = $this->form;

        if ($this->getRequest()->isPost()) {
            $insertTestData = $this->test->addTest(
                $this->getRequest()->getPost(),
                $this->form
            );
            if ($insertTestData) {
                $this->_helper->redirector('index');
            }
            $this->form->populate($this->getRequest()->getPost());
        }
    }


}

