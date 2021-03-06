<?php

class Application_Form_Admin_Staff extends Zend_Form
{       
    
    public function init() {
        
        $this->setMethod('post');
        $this->setName('registrazione staff');
        $this->setAction('');
        
        $this->addElement('text', 'nome', array(
            'label' => 'Nome',
            'required' => 'true',
            'autofocus' => 'true',
            'filters' => array('StringTrim'),
            'validators' => array(
                array('Alpha',
                    'allowWhiteSpace'=>true))));
        
        $this->addElement('text', 'cognome', array(
            'label' => 'Cognome',
            'required' => 'true',
            'filters' => array('StringTrim'),
            'validators' => array(
                array('Alpha',
                'allowWhiteSpace'=>true))));
        
        $this->addElement('text', 'email', array(
            'label' => 'Indirizzo e-mail',
            'required' => 'true',
            'filters' => array('StringTrim'),
            'validators' => array('EmailAddress')));
        
        $this->addElement('text', 'username', array(
            'label' => 'Scegli un nome utente',
            'required' => 'true',
            'filters' => array('StringTrim')));
        
        $this->addElement('password', 'password', array(
            'label' => 'Scegli una password',
            'required' => 'true',
            'filters' => array('StringTrim'),
            'validators' => array(array(
                'StringLength', true, array(6,25)))));
        
//        $this->addElement('password', '', array(
//            'label' => 'Conferma la password',
//            'required' => 'true'));
        
//        $this->addElement('hidden', 'data_registrazione', array(
//            'value' => new Zend_Date()->toString('YYYY-MM-dd HH:mm:ss')));
        
        $this->addElement('hidden', 'livello', array(
            'value' => 'staff'));
        
        $this->addElement('submit', 'add', array(
             'label' => 'Inserisci membro staff'));
    }

}
