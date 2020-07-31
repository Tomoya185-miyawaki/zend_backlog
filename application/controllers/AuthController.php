<?php
class AuthController extends Zend_Controller_Action
{
    public function indexAction()
    {
        return $this->render('login');
    }

    public function loginPageAction()
    {
        $this->renderScript('/auth/login.phtml');
    }
}
