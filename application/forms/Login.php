<?php

class Application_Form_Login extends Zend_Form
{
    public function init()
    {
        $this->setName('login')
             ->setMethod('post')
             ->setAction('/auth/login');

        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'ログイン');

        $this->addElements(array($email, $password, $submit));
    }
}
