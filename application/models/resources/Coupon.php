<?php

class Application_Resource_Coupon extends Zend_Db_Table_Abstract
{
    protected $_name	 = 'coupon';
    protected $_primary	 = 'id';
    protected $_rowClass = 'Application_Resource_Coupon_Item';
    
    public function init()
    {
    }
    
    public function getCoupon()
    {
        $select = $this->select();
        return $this ->fetchAll($select);
    }
    
    public function getCouponByInizioV()
    {
        $select = $this->select()->order('inizio_validita DESC');
        return $this ->fetchAll($select);
    }
    public function getCouponByEmissioni()
    {
        $select = $this->select()->order('emissioni');
        return $this ->fetchAll($select);
    }
    
    public function registraCoupon($info)
    {
        return $this ->insert($info);
    }
    
    
}
