<?php

class Application_Form_Staff_Cambioprofilo extends App_Form_Abstract
{
		
	public function init()
    {
    	              
        $this->setMethod('post');
        $this->setName('cabioprofilo');
        $this->setAction('');  
    	
        $this->setMethod('post');
        $this->setName('cabioprofilo');
        $this->setAction('');  
    	
        $this->addElement('text', 'nome', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Nome',
            'decorators' => $this->elementDecorators,
            
            ));
        
        $this->addElement('text', 'cognome', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Cognome',
            'decorators' => $this->elementDecorators,
            
            ));
			
		$this->addElement('password', 'pass', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Nuova password',
            'decorators' => $this->elementDecorators,
            
            ));
			
		$this->addElement('password', 'conf_pass', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
               array('identical', false, array('token' => 'passwd'))
            ),
            'required'   => true,
            'label'      => 'conferma password',
            'decorators' => $this->elementDecorators,
            
            ));


        $this->addElement('submit', 'cambia', array(
            'required' => false,
            'ignore'   => true,
            'label'    => 'conferma',
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