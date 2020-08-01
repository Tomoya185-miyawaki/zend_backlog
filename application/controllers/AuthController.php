<?php
class AuthController extends Zend_Controller_Action
{
    public function init()
    {
        $this->form = new Application_Form_Login();
    }

    public function indexAction()
    {
        return $this->_helper->redirector('login-page');
    }

    /**
     * ログインページの表示
     */
    public function loginPageAction()
    {
        $this->form->submit->setLabel('ログイン');
        $this->view->form = $this->form;
        $this->renderScript('/auth/login.phtml');
    }

    /**
     * ログイン処理
     */
    public function loginAction()
    {
        if ($this->getRequest()->isPost()) {
//            $insertTestData = $this->test->addTest(
//                $this->getRequest()->getPost(),
//                $this->form
//            );
//            if ($insertTestData) {
//                $this->_helper->redirector('index');
//            }
            var_dump($this->getRequest()->getPost());
            exit;
            $this->form->populate($this->getRequest()->getPost());
        }
        $this->_helper->redirector('login-page');
    }
}
