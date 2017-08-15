<?php
 use Zend\Form\Element;
use Zend\Form\Form;
class Application_Form_Admin_Category extends App_Form_Abstract
{
		
	public function init()
    {
    	              
        $this->setMethod('post');
        $this->setName('aggiungicategoria');
        $this->setAction('');  
    	
    	
    	$this->addElement('text', 'name', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Nome Categoria',
            'decorators' => $this->elementDecorators,
            
            )); 
			
		$this->addElement('textarea', 'desc', array(
            
            'required'   => true,
            'label'      => 'Descrizione',
            'decorators' => $this->elementDecorators,
            
            )); 
			
		  
        
					
		
        $this->addElement('submit', 'aggiungi', array(
            'required' => true,
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