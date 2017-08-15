<?php

class Application_Form_Admin_Faq extends App_Form_Abstract
{
		
	public function init()
    {
    	              
        $this->setMethod('post');
        $this->setName('aggiungifaq');
        $this->setAction('');  
    	
    	
    	 $this->addElement('textarea', 'question', array(
            'label' => 'Domanda',
        	'cols' => '60', 'rows' => '2',
            
            'required' => true,
            'validators' => array(array('StringLength',true, array(5,500))),
            'decorators' => $this->elementDecorators,
        ));
		
		
		 $this->addElement('textarea', 'answer', array(
            'label' => 'Risposta',
        	'cols' => '60', 'rows' => '5',
            
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,1000))),
            'decorators' => $this->elementDecorators,
        ));
			
		
		
  
        
					
		
        $this->addElement('submit', 'conferma', array(
            'required' => FALSE,
            'ignore'   => true,
            'label'    => 'aggiungi',
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
?>