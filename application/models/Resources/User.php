<?php

class Application_Resource_User extends Zend_Db_Table_Abstract
{
    protected $_name    = 'user';
    protected $_primary  = 'usrId';
    protected $_rowClass = 'Application_Resource_User_Item';

	public function init()
    {
    }
	
	public function getUsers()
	{
		$select=$this->select();
		return $this->fetchall($select);
	}
	
	public function getUtenti()
	{
		$select=$this->select()->where('role = ?', 'user');
		return $this->fetchall($select);
	}
    
	public function saveUser($info)
	{
		$this->insert($info);
	}   
	
	public function deleteUserById($user_id)
	{
		$where = $this->getAdapter()->quoteInto('usrId = ?', $user_id);
		$this->delete($where);
	}
	
	public function findUsername($value)
	{
		$select=$this->select()
					 ->from('user')
					 ->where('username IN(?)',$cat_id);
		$query=$this->fetchRow($select);
		$righe=mysql_num_rows($query);
					 
		if($righe==0)
			return TRUE;
		else {
			return FALSE;
		}
	}
	
    public function getUserByName($usrName)
    {
        return $this->fetchRow($this->select()->where('username = ?', $usrName));
    }
	
	public function getUserById($info)
    {
        return $this->fetchRow($this->select()->where('usrId = ?', $info));
    }
	
	public function changeUser($info,$usrId)
    {
    	
        $this->update( $info,'usrId='.$usrId);
			  
    }		
}

