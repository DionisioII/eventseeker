<?php
class Application_Form_Public_Searchbar extends App_Form_Abstract
{
		
	public function init()
    {
    	              
        $this->setMethod('post');
        $this->setName('searchbar');
        $this->setAction('');  
    	
    	
    	 $this->addElement('text', 'search', array(
                  	         
             'required' => true,
             ));
		
		$this->search->setDecorators(array(
    'ViewHelper',
     array('Errors'),
    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
    array('Label', array('tag' => 'td')),
    array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
));
		
		$this->addElement('select','mese',array(
		
		'multiOptions'=>array(
						'tt'=>'tutti i mesi','01'=>'gennaio','02'=>'febbraio',
						'03'=>'marzo','04'=>'aprile','05'=>'maggio','06'=>'giugno',
						'07'=>'luglio','08'=>'agosto','09'=>'settembre','10'=>'ottobre',
						'11'=>'vovembre','12'=>'dicembre'),
		
		'decorators'=> $this->elementDecorators,
		));          
			
		$this->mese->setDecorators(array(
    'ViewHelper',
     array('Errors'),
    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
    array('Label', array('tag' => 'td')),
    array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
)); 



		$locations=array();
		$model=new Application_Model_Event();
		$events=$model->getEvents();
		$locations['tt']='tutti i luoghi';
		foreach ($events as $event) {
        	$locations[$event -> location] = $event->location;       
        }
		
		 $this->addElement('select', 'location', array(
            'multiOptions' => $locations,
            'decorators' => $this->elementDecorators,
        ));
		
		$this->location->setDecorators(array(
    'ViewHelper',
     array('Errors'),
    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
    array('Label', array('tag' => 'td')),
    array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
)); 




		
		$this->addElement('select','anno',array(
		
		'multiOptions'=>array(
						'2013'=>'2013',
						'2014'=>'2014',
						'2015'=>'2015',
						'2016'=>'2016'),	
		'decorators'=> $this->elementDecorators,
		));        
  
    $this->anno->setDecorators(array(
    'ViewHelper',
     array('Errors'),
    array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
    array('Label', array('tag' => 'td')),
    array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
));     
					
		
        $this->addElement('submit', 'cerca', array(
            'required' => FALSE,
            'ignore'   => true,
            'label'    => 'cerca',
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