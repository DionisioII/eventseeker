<?php
 use Zend\Form\Element;
use Zend\Form\Form;
class Application_Form_Admin_User extends App_Form_Abstract
{
		
	public function init()
    {
    	              
        $this->setMethod('post');
        $this->setName('aggiungiutente');
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
			
			$this->addElement('select','role',array(
		'value'=>'user',
		'multiOptions'=>array(
						'user'=>'user','staff'=>'staff','admin'=>'admin'),
		'label'=>'Ruolo',
		'decorators'=> $this->elementDecorators,
		));          
			
		$this->addElement('password','passwd',array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Password',
            'renderPassword'=>true,
            'decorators' => $this->elementDecorators,
            ));
				
				
		$this->addElement('password','conf_password',array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('identical', false, array('token' => 'passwd'))
            ),
            'required'   => true,
            'ignore'   => true,
            'label'      => 'Conferma Password',
            'renderPassword'=>true,
            'decorators' => $this->elementDecorators,
            ));
			
		
  
        
					
		
        $this->addElement('submit', 'aggiungi', array(
            'required' => false,
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