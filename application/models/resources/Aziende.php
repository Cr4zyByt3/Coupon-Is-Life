<?php

class Application_Resource_Aziende extends Zend_Db_Table_Abstract
{
    protected $_name	 = 'aziende';
    protected $_primary	 = 'id';
    protected $_rowClass = 'Application_Resource_Aziende_Item';
    
    public function init()
    {
    }
    
    public function getAziende()
    {
        $select = $this->select();
        return $this ->fetchAll($select);        
    }
    
    public function getAziendeByCoupon_Emessi()
    {
        $select = $this->select()->order('coupon_emessi DESC');
        return $this ->fetchAll($select);        
    }
    
    public function registraAzienda($info)
    {
        return $this ->insert($info);
    }
}
