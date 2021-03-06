<?php

class Application_Resource_Utenti extends Zend_Db_Table_Abstract
{
    protected $_name	 = 'utenti';
    protected $_primary	 = 'id';
    protected $_rowClass = 'Application_Resource_Utenti_Item';
    
    public function init()
    {
    }
    
    public function registraUser($info)
    {
        return $this->insert($info);
    }
    
    public function registraStaff($info)
    {
        return $this->insert($info);
    }
    
    public function getUtenteByNome($username)
    {
        $select = $this->select()->where('username = ?', $username);
        return $this->fetchRow($select);
    }
    
    public function getUsers()
    {
        $select = $this->select()->where('livello = ?', 'user');
        return $this->fetchAll($select);
    }
    
    public function getStaff()
    {
        $select = $this->select()->where('livello = ?', 'staff')->order('id');
        return $this->fetchAll($select);
    }
}
