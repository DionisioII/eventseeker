<?php

class Zend_View_Helper_UsernameHelper extends Zend_View_Helper_Abstract
{   
    protected $_adminModel;
	
    public function usernameHelper ($usrId_send)
    {
    	$this->_adminModel=new Application_Model_Admin();
		$user=$this->_adminModel->getUserById($usrId_send);
		return $user;
	}

	
}
