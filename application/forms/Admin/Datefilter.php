<?php
class Application_Form_Admin_Datefilter extends App_Form_Abstract
{
		
	public function init()
    {
    	              
        $this->setMethod('post');
        $this->setName('datefilter');
        $this->setAction('');  
		
		 $ValidateDate = new Zend_Validate_Date();
		 $ValidateDate->setLocale(new Zend_Locale('it_IT'));
    	
    	
    	 $this->addElement('text', 'date1', array(
            'label' => 'Dal',        	         
            'required' => true,
            'validators' => array($ValidateDate),
            
        ));
		
		$this->date1->setDecorators(array(
    'ViewHelper',
     array('Errors'),
    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
    array('Label', array('tag' => 'td')),
    array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
));
		
		
		 $this->addElement('text', 'date2', array(
            'label' => 'al',           
            'required' => true,
            'validators' => array(array($ValidateDate)),
            
        ));
		
		$this->date2->setDecorators(array(
    'ViewHelper',
     array('Errors'),
    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
    array('Label', array('tag' => 'td')),
    array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
));
			
		
		
  
        
					
		
        $this->addElement('submit', 'conferma', array(
            'required' => FALSE,
            'ignore'   => true,
            'label'    => 'filtra',
            'decorators' => $this->buttonDecorators,
        ));

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'td')),
        	array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }
}
?>