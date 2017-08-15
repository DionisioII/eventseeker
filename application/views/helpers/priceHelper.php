<?php

class Zend_View_Helper_PriceHelper extends Zend_View_Helper_Abstract
{   
    protected $_eventModel;
	
    public function priceHelper ($event_id)
    {
    	$this->_eventModel=new Application_Model_Event();
		$price=$this->_eventModel->getBigliettiById($event_id);
		return $price;
	}

	
}
