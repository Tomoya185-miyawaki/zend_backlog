<?php
class AuthController extends Zend_Controller_Action
{
    const AUTH_TABLE_NAME = 'users';
    const AUTH_ID_NAME    = 'email';
    const AUTH_PASS_NAME  = 'password';

    private $authInfo = array();

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
        // ログイン済みならばトップページへリダイレクト
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity())
        {
            $this->_helper->redirector('index', 'index');
        }
        $this->form->submit->setLabel('ログイン');
        $this->view->form = $this->form;
        $this->renderScript('/auth/login.phtml');
    }

    /**
     * ログイン処理
     */
    public function loginAction()
    {
        $dbAdapter = new Zend_Db_Adapter_Pdo_Mysql(array(
            'host'     => 'localhost',
            'username' => 'root',
            'password' => 'root',
            'dbname'   => 'zend_backlog'
        ));
        $authAdapter = new Zend_Auth_Adapter_DbTable(
            $dbAdapter,
            self::AUTH_TABLE_NAME,
            self::AUTH_ID_NAME,
            self::AUTH_PASS_NAME
        );

        // リクエストパラメーター
        $email = $this->getRequest()->getParam('email', '');
        $password = $this->getRequest()->getParam('password', '');
        if ($email === '' || $password === '') {
            // EmailまたはPasswordがない場合はログインページへ戻す
            return $this->_helper->redirector('login-page');
        }
        // メールアドレスとパスワードをセットする
        $authAdapter->setIdentity($email);
        $authAdapter->setCredential($password);
        // 認証する
        $result = $authAdapter->authenticate();
        if ($result->isValid()) {
            // 認証OK
            // 認証済みの情報をセッションに格納する
            $storage = Zend_Auth::getInstance()->getStorage();
            $resultRow = $authAdapter->getResultRowObject(array('email'));
            $storage->write($resultRow);
            // セッションID再生成
            session_regenerate_id(true);
            // ログイン後はトップページへ
            return $this->_helper->redirector('index', 'index');
        }
        // 認証NG
        $this->_helper->redirector('login-page');
    }

    /**
     * ログアウトする
     */
    public function logoutAction()
    {
        $authStorage = Zend_Auth::getInstance()->getStorage();
        $authStorage->clear();
        return $this->_helper->redirector('login-page');
    }
}
