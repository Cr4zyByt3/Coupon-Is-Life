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
    }
    
    public function aziendeAction()
    {
        $az=$this->_guestModel->getAziende();
        $this->view->assign(array('aziende' => $az));
    }
    
    public function categorieAction()
    {
        $cat=$this->_guestModel->getCategorie();
        $this->view->assign(array('categorie' => $cat));
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
    
    public function loginAction()
    {
    }

    public function registerAction()
    {
    }
    
    public function registraAction()
    {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index','public');
        }
	$formReg=$this->_formReg;
        if (!$formReg->isValid($_POST)) {
            return $this->render('register');
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
            $this->_helper->redirector('login','public');
        }
	$formLog = $this->_formLog;
        if (!$formLog->isValid($request->getPost())) {
            return $this->render('login');
        }
        if (false === $this->_authService->authenticate($formLog->getValues())) {
            return $this->render('login');
        }
        $livello = $this->_authService->getIdentity()->livello;
        return $this->_helper->redirector('index', $livello);
    }

    public function ricercaAction()
    { 
      $textbox = $_POST['testo']; //textbox
      $filtro = $_POST['filtro']; //filtro di ricerca:categoria/coupon/entrambe
      //$query = "SELECT * from coupon where categorie.nome like $value1 OR categorie.descrizione like $value1";
      //print_r($_POST);

       switch ($filtro) {
                 
                  case 'categoria':
                    
                      $risultati = $this->_guestModel->getRicercaByCat($textbox);
                      $this->view->assign(array('risultati'=>$risultati));

                    break;
                 
                  case 'coupon':

                      $risultati = $this->_guestModel->getRicercaByCoupon($textbox);
                      $this->view->assign(array('risultati'=>$risultati));

                    break;
                 
                  default:
                     $risultati = array();
                     $risultati['categoria']=$this->_guestModel->getRicercaByCat($textbox);
                     $risultati['coupon'] = $this->_guestModel->getRicercaByCoupon($textbox);
                      
                    $this->view->assign(array(
                                        'risultati1' => $risultati['categoria'],
                                        'risultati2'  => $risultati['coupon']));                

                }

                


    }
}