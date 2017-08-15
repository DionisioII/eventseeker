<?php

class Application_Form_User_Cambioprofilo extends App_Form_Abstract
{
		
	public function init()
    {
    	              
        $this->setMethod('post');
        $this->setName('cambioprofilo');
        $this->setAction('');  
    	
		
		  $this->addElement('text', 'username', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Username',
            'decorators' => $this->elementDecorators,
            
            ));
		
		
        $this->addElement('text', 'name', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Nome',
            'decorators' => $this->elementDecorators,
            
            ));
        
        $this->addElement('text', 'surname', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Cognome',
            'decorators' => $this->elementDecorators,
            
            ));
			
		$this->addElement('password', 'passwd', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'renderPassword'=>true,
            'label'      => 'Nuova password',
            'decorators' => $this->elementDecorators,
            
            ));
			
		$this->addElement('password', 'conf_pass', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('identical', false, array('token' => 'passwd'))
            ),
            'required'   => true,
            'renderPassword'=>true,
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