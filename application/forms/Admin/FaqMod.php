<?php

class Application_Form_Admin_FaqMod extends Zend_Form
{
    public function init() {
        
        $this->setMethod('post');
        $this->setName('modifica faq');
        $this->setAction('');
        
        $this->addElement('textarea', 'domanda', array(
            'label' => 'Domanda',
        	'cols' => '100', 'rows' => '5',
            'filters' => array('StringTrim'),
            'required' => true,
            'autofocus'  => true,
            'placeholder' => 'Inserisci il testo della domanda',
            'validators' => array(array('StringLength',true, array(1,2500)))
        ));
        
        $this->addElement('textarea', 'risposta', array(
            'label' => 'Risposta',
        	'cols' => '100', 'rows' => '10',
            'filters' => array('StringTrim'),
            'required' => true,
            'placeholder' => 'Inserisci la risposta',
            'validators' => array(array('StringLength',true, array(1,2500)))
        ));
        
        $this->addElement('hidden', 'idModifica',array(
            'required' => true
        ));
        
        $this->addElement('submit', 'modifica', array(
            'label' => 'Applica modifiche',
            'class' => 'btn btn-primary'));
        
        $this->addElement('submit', 'cancella', array(
            'label' => 'Cancella FAQ',
            'class' => 'btn btn-primary'));
    }

}
