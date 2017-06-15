<?php

class Application_Form_Public_Auth_Login extends App_Form_Abstract
{
    public function init()
    {               
        $this->setMethod('post');
        $this->setName('login');
        $this->setAction('');
    	
        
        $this->addElement('text', 'username', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'required'   => true,
            'label'      => 'Username',
            'decorators' => $this->elementDecorators
            ));
        
        $this->addElement('password', 'password', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'label'      => 'Password',
            'decorators' => $this->elementDecorators
            ));

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
