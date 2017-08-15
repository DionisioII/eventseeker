<?php

class Application_Form_User_Prenotazione extends App_Form_Abstract
{
		
	public function init()
    {
    	              
        $this->setMethod('post');
        $this->setName('validateprenotazione');
        $this->setAction('');  
		$this->setAttrib('enctype', 'multipart/form-data'); 
    	
        $this->addElement('select', 'sezione', array(
            'label' => 'Tipologia biglietto',
            'required' => TRUE,
        	'registerInArrayValidator' => false,
            'decorators' => $this->elementDecorators,
        ));
		
		$validator = new Zend_Validate_Int(array('locale' => 'it'));
        
       $this->addElement('text', 'num_biglietti', array(
            
         'validators' => array(
         				array($validator, false)
            ),
            'required'   => TRUE,
            'label'      => 'Numero Biglietti',
            'decorators' => $this->elementDecorators,
            
            ));
			
		 $this->addElement('select', 'tip_pagamento', array(
            'label' => 'Tipologia Pagamento',
            'required' => TRUE,
        	'multiOptions' => array( 'Paypal'=>'Paypal',
        							'Bonifico bancario'=>'bonifico bancario',
        							'pagamento presso i nostri uffici'=>'pagamento presso i nostri uffici'	),
            'decorators' => $this->elementDecorators,
        ));
		
		$this->addElement('select', 'tip_recapito', array(
            'label' => 'Recapito Biglietti',
            'required' => TRUE,
        	'multiOptions' => array( 'Spedizione a casa'=>'Spedizione a casa',
        							'ritiro al botteghino'=>'ritiro al botteghino',
        							'ritiro presso i nostri uffici'=>'ritiro presso i nostri uffici'	),
            'decorators' => $this->elementDecorators,
        ));

        $this->addElement('submit', 'login', array(
            
            'label'    => 'Acquista',
            'decorators' => $this->buttonDecorators,
        ));

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table')),
        	array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }
}
