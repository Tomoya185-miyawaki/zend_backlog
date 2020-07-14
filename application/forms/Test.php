<?php

class Application_Form_Test extends Zend_Form
{
    public function init()
    {
        $this->setName('test');

        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');

        $title = new Zend_Form_Element_Text('title');
        $title->setLabel('Title')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $content = new Zend_Form_Element_Text('content');
        $content->setLabel('Content')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', '作成する');

        $this->addElements(array($id, $title, $content, $submit));
    }
}
