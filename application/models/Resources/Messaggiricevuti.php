<?php
    class Application_Resource_Messaggiricevuti extends Zend_Db_Table_Abstract
{
    protected $_name    = 'messaggiricevuti';
    protected $_primary  = 'id_messaggio';
    protected $_rowClass = 'Application_Resource_Messaggiricevuti_Item';
    
	public function init()
    {
    }
	
	

    public function getMessaggiRicevutiById($id,$role=null)
    {
        $select=$this->select()
					 ->from('messaggiricevuti')
					 ->where('role IN(?)',$id)
					 ->orwhere('role IN(?)',$role);
		return $this->fetchAll($select);
    }
    
	public function getMessaggioById($id_messaggio)
	{
		$select=$this->select()
					 ->from('messaggiricevuti')
					 ->where('id_messaggio IN(?)',$id_messaggio);
		return $this->fetchRow($select);	
	}
	
	public function inviaMessaggio($info)
	{
		$this->insert($info);
	}
	
	public function deleteMessaggioRicevuto($id)
	{
		$where = $this->getAdapter()->quoteInto('id_messaggio = ?', $id);
		$this->delete($where);
	}
    
}
?>