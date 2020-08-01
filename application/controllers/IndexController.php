<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // 未ログイン状態ならばログインページへリダイレクト
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity())
        {
            $this->_helper->redirector('login-page', 'auth');
        }
    }

    public function addAction()
    {
        // add Action
    }


}

