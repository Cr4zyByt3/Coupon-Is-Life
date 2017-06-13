<?php

class StaffController extends Zend_Controller_Action
{	
    protected $_authService;
    protected $_staffModel;
    protected $_adminModel;
    protected $_userModel;
    protected $_formCoupon;
    protected $_formCouponMod;
    protected $_formPassword;
    protected $_formDati;
    protected $_auth;

    public function init()
    {
        $this->_helper->layout->setLayout('main');
        $this->_auth = Zend_Auth::getInstance();
	$this->_authService = new Application_Service_Auth();
        $this->_staffModel = new Application_Model_Staff();
        $this->_adminModel = new Application_Model_Admin();
        $this->_userModel = new Application_Model_User();
        $this->_formDati = new Application_Form_Staff_Dati();
        $this->_formPassword = new Application_Form_Staff_Password();
        $this->view->couponForm = $this->getCouponForm();
        $this->view->couponModForm = $this->getCouponModForm();
        $this->view->datiForm = $this->getDatiForm();
        $this->view->passwordForm = $this->getPasswordForm();
    }

    public function indexAction()
    {
        return $this->_helper->redirector('strumenti','staff');
    }
    
    public function strumentiAction()
    {
    }

    public function logoutAction()
    {
	$this->_authService->clear();
	return $this->_helper->redirector('index','public');	
    }
    
    public function formcouponAction()
    {
    }
    
    public function formcouponmodAction()
    {
        $idModifica = $_GET["chosen"];
        if(!$idModifica)
        {
            $this->_helper->redirector('coupon', 'staff');
        }
        $query = $this->_staffModel->getCouponById($idModifica)->toArray();
        $query['idModifica'] = $idModifica;
        $this->_formCouponMod->populate($query);
    }
    
    public function couponAction()
    {
        $coupon = $this->_staffModel->getCoupon()->toArray();
        $size = count($coupon);
        for ($i=0; $i<$size; $i++)
        {
            $azienda = $this->_adminModel->getAziendaById($coupon[$i]['idAzienda']);
            $categoria = $this->_adminModel->getCategoriaById($coupon[$i]['idCategoria']);
            $coupon[$i]['azienda'] = $azienda->nome;
            $coupon[$i]['categoria'] = $categoria->nome;
        }
        $this->view->assign(array('coupon' => $coupon));
    }
    
    public function registracouponAction()
    {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('formcoupon','staff');
        }
	$formCoupon=$this->_formCoupon;
        if (!$formCoupon->isValid($_POST)) {
            return $this->render('formcoupon');
        }
        $values = $formCoupon->getValues();
       	$this->_staffModel->registraCoupon($values);
    }
    
    public function modificacouponAction()
    {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('formcouponmod','staff');
        }
        $formCouponMod=$this->_formCouponMod;
        if (!$formCouponMod->isValid($_POST)) {
            return $this->render('formcouponmod');
        }
        $values = array(
            'nome'=>$formCouponMod->getValue('nome'),
            'descrizione'=>$formCouponMod->getValue('descrizione'),
            'inizio_validita'=>$formCouponMod->getValue('inizio_validita'),
            'scadenza'=>$formCouponMod->getValue('scadenza'),
            'luogo_di_fruizione'=>$formCouponMod->getValue('luogo_di_fruizione'),
            'idCategoria'=>$formCouponMod->getValue('idCategoria'),
            'idAzienda'=>$formCouponMod->getValue('idAzienda'),
            'emissioni'=>$formCouponMod->getValue('emissioni'),
            'immagine'=>$formCouponMod->getValue('immagine')
                );
        $idModifica = $formCouponMod->getValue('idModifica');
        $cancella = $formCouponMod->getValue('cancella');
        if($cancella)
        {
            $this->_staffModel->delCoupon($idModifica);
            return $this->render('cancellacoupon');
        }
       	$this->_staffModel->modificaCoupon($values, $idModifica);
        $modificato=$this->_staffModel->getCouponById($idModifica);
        $this->view->assign(array('modificata'=>$modificata));   
    }
    
    private function getCouponForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_formCoupon = new Application_Form_Staff_Coupon();
        $this->_formCoupon->setAction($urlHelper->url(array(
                        'controller' => 'staff',
                        'action' => 'registracoupon'),
                        'default'
                        ));
        return $this->_formCoupon;
    }
    
    private function getCouponModForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_formCouponMod = new Application_Form_Staff_CouponMod();
        $this->_formCouponMod->setAction($urlHelper->url(array(
                        'controller' => 'staff',
                        'action' => 'modificacoupon'),
                        'default'
                        ));
        return $this->_formCouponMod;
    }
    
    public function formdatiAction()
    {
        $idModifica = $this->_auth->getIdentity()->id;
        $query = $this->_adminModel->getUtenteById($idModifica)->toArray();
        $query['idModifica'] = $idModifica;
        $this->_formDati->populate($query);       
    }
    
    public function formpasswordAction()
    {
    }
    
    public function modificadatiAction()
    {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('formdati','staff');
        }
        $formDati=$this->_formDati;
        if (!$formDati->isValid($_POST)) {
            return $this->render('formdati');
        }
        $values = $formDati->getValues();
        $idModifica = $this->_auth->getIdentity()->id;
       	$this->_userModel->modificaDati($values, $idModifica);
        $modificato=$this->_adminModel->getUtenteById($idModifica);
        $this->view->assign(array('modificato'=>$modificato));
    }
    
    public function passwordAction()
    {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('formpassword','staff');
        }
	$formPassword=$this->_formPassword;
        if (!$formPassword->isValid($_POST)) {
            return $this->render('formpassword');
        }
        $oldPass = $formPassword->getValue('old_password');
        $newPass = $formPassword->getValue('password');
        $idModifica = $this->_auth->getIdentity()->id;
//        if ($values['old_password']!= $idModifica) {
//            $this->_helper->redirector('formpassword','user');
//        }
       	$this->_userModel->modificaPassword($newPass, $idModifica);
    }
    
    private function getDatiForm()
    { 
        $urlHelper = $this->_helper->getHelper('url');
        $this->_formDati->setAction($urlHelper->url(array(
                        'controller' => 'staff',
                        'action' => 'modificadati'),
                        'default'
                        ));
        return $this->_formDati;
    }
    
    
    private function getPasswordForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_formPassword->setAction($urlHelper->url(array(
                        'controller' => 'staff',
                        'action' => 'password'),
                        'default'
                        ));
        return $this->_formPassword;
    }
}

