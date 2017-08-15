<?php

class Application_Form_Staff_AggiungiTipologia extends App_Form_Abstract
{
		
	public function init()
    {
    	              
        $this->setMethod('post');
        $this->setName('aggiungitipologia');
        $this->setAction('');  
    	
        $this->addElement('text', 'sezione', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => ' tipologia biglietto',
            'decorators' => $this->elementDecorators,
            
            ));
        
        $this->addElement('text', 'prezzo', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('Float')
            ),
            'required'   => true,
            'label'      => 'prezzo',
            'decorators' => $this->elementDecorators,
            
            ));
			
		$this->addElement('text', 'num_max', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('int', false)
            ),
            'required'   => true,
            'label'      => 'Posti disponibili',
            'decorators' => $this->elementDecorators,
            
            ));
			
		


        $this->addElement('submit', 'aggiungi', array(
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