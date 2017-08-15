<?php
    class Application_Resource_Prenotazione extends Zend_Db_Table_Abstract
{
    protected $_name    = 'prenotazione';
    protected $_primary  = 'prenotazione_id';
    protected $_rowClass = 'Application_Resource_Prenotazione_Item';
    
	public function init()
    {
    }
	
	public function PrenotaEvento($info)
    {
    	$this->insert($info);
    }

	public function visualizzaEventiByUserId($id)
	{
		$select=$this->select()
					 ->from('prenotazione')
					 ->where('usrId IN(?)',$id);
		return $this->fetchAll($select);
	}
	
	public function getRowByID($id)
	{
		$select=$this->select()
					 ->from('prenotazione')
					 ->where('prenotazione_id IN(?)',$id);
		return $this->fetchRow($select);
	}
    
	
}
?>