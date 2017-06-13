<?php

class Application_Model_Guest extends App_Model_Abstract
{
    public function __construct()
    {
    }
    
    public function getCategorie()
    {
        return $this->getResource('Categorie')->getCategorie();
    }
    
    public function getCategoriaById($id)
    {
        return $this->getResource('Categorie')->getCategoriaById($id);
    }
    
    public function getCategorieByTot_Emissioni()
    {
        return $this->getResource('Categorie')->getAziendeByTot_Emissioni();
    }
    
    public function getAziende()
    {
        return $this->getResource('Aziende')->getAziende();
    }
    
    public function getAziendaById($id)
    {
        return $this->getResource('Aziende')->getAziendaById($id);
    }
    
    public function getAziendeByCoupon_Emessi()
    {
        return $this->getResource('Aziende')->getAziendeByCoupon_Emessi();
    }
    
    public function getCoupon()
    {
        return $this->getResource('Coupon')->getCoupon();
    }
    
    public function getCouponByInizioV()
    {
        return $this->getResource('Coupon')->getCouponByInizioV();    
    }
    
     public function getCouponByEmissioni()
    {
        return $this->getResource('Coupon')->getCouponByEmissioni();    
    }
    
    public function getCouponById($id)
    {
        return $this->getResource('Coupon')->getCouponById($id);
    }
    
    public function getCouponByAzienda($id) 
    {
        return $this->getResource('Coupon')->getCouponByAzienda($id);
    }
    
    public function getCouponByCategoria($id) 
    {
        return $this->getResource('Coupon')->getCouponByCategoria($id);
    }
    
    public function getFaq()
    {
        return $this->getResource('Faq')->getFaq();
    }
    
    /* I due metodi successivi eseguono le stesse istruzioni, ma si è
    * scelto di separarli in quanto sono azioni concettualmente diverse */
    public function registraUser($info)
    {
    	return $this->getResource('Utenti')->registraUser($info);
    }
        
    public function getUtenteByNome($info)
    {
    	return $this->getResource('Utenti')->getUtenteByNome($info);
    }
}
