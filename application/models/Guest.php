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
    
    public function getAziende()
    {
        return $this->getResource('Aziende')->getAziende();
    }
    
    public function getFaq()
    {
        return $this->getResource('Faq')->getFaq();
    }

    public function getRicercaByCat($textbox)
    {

        return $this->getResource('Categorie')->getRicercaByCat($textbox);
         //$this->getResource('Categorie')->getRicerca();
    }


    public function getRicercaByCoupon($textbox)
    {

        return $this->getResource('Coupon')->getRicercaByCoupon($textbox);
        //return $this->getResource('Categorie')->getRicercaByCat($value1);
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
