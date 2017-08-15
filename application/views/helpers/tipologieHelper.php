<?php

class Zend_View_Helper_TipologieHelper extends Zend_View_Helper_Abstract
{   
    protected $_eventModel;
	
    public function tipologieHelper ($event_id)
    {
    	$this->_eventModel=new Application_Model_Event();
		$tipologie='';
		$biglietti=$this->_eventModel->getBigliettiById($event_id);
		if (isset($biglietti)){
		
		return $biglietti;	
		}
		return null;
	}

	
}
