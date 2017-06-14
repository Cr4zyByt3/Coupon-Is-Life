<?php

class Application_Form_Public_Auth_Login extends App_Form_Abstract
{
    public function init()
    {               
        $this->setMethod('post');
        $this->setName('login');
        $this->setAction('');
    	
        // Validatori per controllare l'esistenza delle credenziali immesse
        $esisteUser = new Zend_Validate_Db_RecordExists(
                array(
                    'adapter'=> Zend_Db_Table_Abstract::getDefaultAdapter(),
                    'table' => 'utenti',
                    'field' => 'username'
                    ));
        $esisteUser->setMessage('Username errato');
        
        $esistePass = new Zend_Validate_Db_RecordExists(
                array(
                    'adapter'=> Zend_Db_Table_Abstract::getDefaultAdapter(),
                    'table' => 'utenti',
                    'field' => 'password'
                    ));
        $esistePass->setMessage('Password errata');
        
        $this->addElement('text', 'username', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'required'   => true,
            'autofocus'  => true,
            'label'      => 'Username',
            'decorators' => $this->elementDecorators
            ));
        $this->getElement('username')->addValidator($esisteUser);
        
        $this->addElement('password', 'password', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'label'      => 'Password',
            'decorators' => $this->elementDecorators
            ));
        $this->getElement('password')->addValidator($esistePass);

        $this->addElement('submit', 'login', array(
            'label'    => 'Login',
            'class'    => 'btn btn-primary',
            'decorators' => $this->buttonDecorators
        ));
        
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'div', 'class' => 'zend_form')),
        	array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));

    }
}
