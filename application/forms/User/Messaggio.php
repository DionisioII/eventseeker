<?php

class Application_Form_User_Messaggio extends App_Form_Abstract
{
		
	public function init()
    {
    	              
        $this->setMethod('post');
        $this->setName('messaggio');
        $this->setAction('');  
		
		$this->addElement('select', 'role', array(
            'label' => 'destinatario',
		    'multiOptions'=>array('staff'=>'staff'),
            'required' => TRUE,
        	
            'decorators' => $this->elementDecorators,
        ));
    	
        
        
        $this->addElement('text', 'oggetto', array(
            
            'validators' => array(
                array('StringLength', true, array(1, 40))
            ),
            'required'   => true,
            'label'      => 'oggetto',
            'decorators' => $this->elementDecorators,
            'order'=> 2
            
            ));
			
		$this->addElement('textarea', 'message', array(
               
            'required'   => true,
            'label'      => 'Messaggio',
            'decorators' => $this->elementDecorators,
            'order'=> 3
            
            ));
			
		


        $this->addElement('submit', 'invia', array(
            'required' => false,
            'ignore'   => true,
            'label'    => 'invia',
            'order'=>4,
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