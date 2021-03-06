<?php

class PublicController extends Zend_Controller_Action
{
    protected $_guestModel;
    protected $_formReg;
    protected $_formLog;
    protected $_authService;
    
    public function init()
    {
	$this->_helper->layout->setLayout('main');
        $this->_guestModel = new Application_Model_Guest();
        $this->_authService = new Application_Service_Auth();
        $this->view->userForm = $this->getUserForm();
        $this->view->loginForm = $this->getLoginForm();
    }
    
    public function indexAction()
    {
        $categorie= $this->_guestModel->getCategorieByTot_Emissioni();
        $aziende= $this->_guestModel->getAziendeByCoupon_Emessi();
        $coupon=$this->_guestModel->getCouponByInizioV();
        $coup=$this->_guestModel->getCouponByEmissioni();
        $this->view->assign(array('coupon' => $coupon,
                                  'coup'=> $coup,
                                  'aziende'=> $aziende,
                                   'categorie'=>$categorie ));
    }
    
    public function aziendeAction()
    {
        $az=$this->_guestModel->getAziende();
        $this->view->assign(array('aziende' => $az));
    }
    
     public function aziendaAction()
    {
        $id= $this->getParam('selAzienda');
        $azienda=$this->_guestModel->getAziendaById($id);
        $coupon= $this->_guestModel->getCouponByAzienda($id);
        $this->view->assign(array('azienda' => $azienda,
                                  'coupon' => $coupon));
    }
    
     public function categoriaAction()
    {
        $id= $this->getParam('selCat');
        $categoria=$this->_guestModel->getCategoriaById($id);
        $coupon= $this->_guestModel->getCouponByCategoria($id);
        $this->view->assign(array('categoria' => $categoria,
                                  'coupon'=>$coupon));
    }
    
    public function categorieAction()
    {
        $cat=$this->_guestModel->getCategorie();
        $this->view->assign(array('categorie' => $cat));
    }
    
    public function couponAction()
    {
        $id= $this->getParam('selCoupon');
        $coupon=$this->_guestModel->getCouponById($id);
        $this->view->assign(array('coupon' => $coupon));
    }
    
    public function faqAction() 
    { 
        $faq= $this->_guestModel->getFaq(); 
        $this->view->assign(array('faq'=> $faq));
    }
    
    public function viewstaticAction()
    {
    	$page = $this->_getParam('staticPage');
    	$this->render($page);
    }
    
    public function logregAction()
    {
    }
    
    public function registraAction()
    {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index','public');
        }
	$formReg=$this->_formReg;
        if (!$formReg->isValid($_POST)) {
            return $this->render('logreg');
        }
        $values = $formReg->getValues();
       	$this->_guestModel->registraUser($values);
    }
    
    private function getLoginForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_formLog = new Application_Form_Public_Auth_Login();
        $this->_formLog->setAction($urlHelper->url(array(
                        'controller' => 'public',
                        'action' => 'authenticate'),
                        'default'
                        ));
        return $this->_formLog;
    }
    
    private function getUserForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_formReg = new Application_Form_Public_User();
        $this->_formReg->setAction($urlHelper->url(array(
                        'controller' => 'public',
                        'action' => 'registra'),
                        'default'
                        ));
        return $this->_formReg;
    }
    
    public function authenticateAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            $this->_helper->redirector('logreg','public');
        }
	$formLog = $this->_formLog;
        if (!$formLog->isValid($request->getPost())) {
            return $this->render('logreg');
        }
        if (false === $this->_authService->authenticate($formLog->getValues())) {
            return $this->render('logreg');
        }
        $livello = $this->_authService->getIdentity()->livello;
        return $this->_helper->redirector('index', $livello);
    }
}