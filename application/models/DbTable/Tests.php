<?php

class Application_Model_DbTable_Tests extends Zend_Db_Table_Abstract
{
    protected $_name = 'tests';

    public function init()
    {
    }

    public function getTest($id)
    {
        $row = $this->fetchRow('id = ' . (int)$id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    /**
     * @param array $request フォームから送られてきたデータ
     * @param array $form
     * @return bool
     */
    public function addTest($request, $form)
    {
        $formData = $request;
        if ($form->isValid($formData)) {
            $title = $form->getValue('title');
            $content = $form->getValue('content');
            $this->addDbTest($title, $content);
            return true;
        }
        return false;
    }

    /**
     * @param string $title タイトル
     * @param string $content コンテンツ
     */
    private function addDbTest($title, $content)
    {
        $insertData = array(
            'title'   => $title,
            'content' => $content
        );
        $this->insert($insertData);
    }
}
