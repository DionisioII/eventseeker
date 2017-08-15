<?php

class Application_Model_Admin extends App_Model_Abstract
{ 

	public function __construct()
    {
    }
	
	public function getUtenti()
	{
		return $this->getResource('User')->getUtenti();
	}
	
	public function getUsers()
	{
		return $this->getResource('User')->getUsers();
	}
	
	public function deleteUserById($user_id)
	{
		return $this->getResource('User')->deleteUserById($user_id);
	}
	
	    public function getUserByName($info)
    {
    	return $this->getResource('User')->getUserByName($info);
    }
	
	public function getUserById($info)
    {
    	return $this->getResource('User')->getUserById($info);
    }
	
	public function saveUser($info)
    {
    	return $this->getResource('User')->saveUser($info);
    }
	
	public function changeUser($info,$usrId)
    {
    	return $this->getResource('User')->changeUser($info,$usrId);
    }
	
	public function findUsername($value)
    {
    	return $this->getResource('User')->findUsername($value);
    }
	
	public function SendMessage($info)
    {
    	return $this->getresource('messaggi')->SendMessage($info);
    }

	public function getMessagesByUserId($id)
	{
		return $this->getresource('messaggi')->getMessagesByUserId($id);
	}
}
?>