<?php

class Zend_View_Helper_CategoryHelper extends Zend_View_Helper_Abstract
{   
    protected $_eventModel;
	
    public function categoryHelper ($catId)
    {
    	$this->_eventModel=new Application_Model_Event();
		$cat=$this->_eventModel->getCatById($catId);
		return $cat->name;
	}

	
}
