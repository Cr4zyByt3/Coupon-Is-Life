<?php

class Application_Resource_Faq extends Zend_Db_Table_Abstract	// viene bypassata la cartella Models perchè così è stato detto all'Autoloader
{
    protected $_name	 = 'faq';
    protected $_primary	 = 'id';
    protected $_rowClass = 'Application_Resource_Faq_Item';
    
    public function init()
    {
    }
    
    public function getFaq()
    {
     $select= $this->select();
     return $this->fetchAll($select);
    }
    
    public function registraFaq($info)
    {
        return $this->insert($info);
    }
}
