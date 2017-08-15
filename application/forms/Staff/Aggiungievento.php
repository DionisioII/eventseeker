<?php
 use Zend\Form\Element;
use Zend\Form\Form;
class Application_Form_Staff_Aggiungievento extends App_Form_Abstract
{
		
	public function init()
    {
    	              
        $this->setMethod('post');
        $this->setName('validateaggiungievento');
        $this->setAction(''); 
		$this->setAttrib('enctype', 'multipart/form-data'); 
    	
		 /*$selectCategory= new App_Form_Element_SelectCategory('cat_id');
		$selectCategory->setLabel('Categoria');
		$selectCategory->setRequired(TRUE);
		$selectCategory->addValidator('NotEmpty');
		//$selectCategory->addDecorator($this->elementDecorators);
		
		$this->addElement($selectCategory);*/
		
		$categories = array();
        $model=new Application_Model_Event();
		$cats=$model->getCats();
        foreach ($cats as $cat) {
        	$categories[$cat -> catId] = $cat->name;       
        }
        $this->addElement('select', 'cat_Id', array(
            'label' => 'Categoria',
            'required' => true,
        	'multiOptions' => $categories,
            'decorators' => $this->elementDecorators,
        ));
		
        $this->addElement('text', 'name', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Nome*',
            'decorators' => $this->elementDecorators,
            
            ));      
        
					
		$this->addElement('text', 'date', array(
            
            'required'   => TRUE,
            'label'      => 'Data*',
            'validators' => array(
                array('Date')
            ),
            'decorators' => $this->elementDecorators,
            
            ));
			
			
			
			$this->addElement('text', 'start_time', array(
            
            'required'   => TRUE,
            'label'      => 'Orario inizio*',
            'decorators' => $this->elementDecorators,
            
            ));
			
			
			
	
 			    
	    $this->addElement('text', 'location', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => TRUE,
            'label'      => 'Dove*',
            'decorators' => $this->elementDecorators,
            
            ));

			
				
		
			
			$this->addElement('textarea', 'description', array(
            
            'required'   => true,
            'label'      => 'descrizione*',
            'decorators' => $this->elementDecorators,
            
            ));
			
			$this->addElement('text', 'image', array(
            
            'required'   => FALSE,
            'label'      => 'nome immagine associata',
            'decorators' => $this->elementDecorators,
            
            ));
			
			 $this->addElement('file', 'image', array(
        	'label' => 'Immagine',
        	'destination' => APPLICATION_PATH . '/../public/images/events',
        	'validators' => array( 
        			array('Count', false, 1),
        			array('Size', false, 11102400),
        			array('Extension', false, array('jpg', 'gif'))),
            'decorators' => $this->fileDecorators,
        			));
               

        $this->addElement('submit', 'add', array(
            
            
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