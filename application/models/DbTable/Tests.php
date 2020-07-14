<?php

class Application_Model_DbTable_Tests extends Zend_Db_Table_Abstract
{
    protected $_name = 'tests';

    public function getTest($id)
    {
        $row = $this->fetchRow('id = ' . (int)$id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function addTest($title, $content)
    {
        $insertData = array(
            'title'   => $title,
            'content' => $content
        );
        $this->insert($insertData);
    }
}
