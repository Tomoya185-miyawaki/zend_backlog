<?php

class TestController extends Zend_Controller_Action
{

    public function init()
    {
    }

    public function indexAction()
    {
        $tests = new Application_Model_DbTable_Tests();
        $this->view->tests = $tests->fetchAll();
    }

    public function addAction()
    {
        // add Action
    }


}

