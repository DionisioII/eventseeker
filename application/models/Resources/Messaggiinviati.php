<?php
    class Application_Resource_Messaggiinviati extends Zend_Db_Table_Abstract
{
    protected $_name    = 'messaggiinviati';
    protected $_primary  = 'id_messaggio';
    protected $_rowClass = 'Application_Resource_Messaggiinviati_Item';
    
	public function init()
    {
    }
	
	public function SendMessage($info)
    {
    	$this->insert($info);
    }

    public function getMessaggiInviatiById($id)
    {
        $select=$this->select()
					 ->from('messaggiinviati')
					 ->where('usrId_send IN(?)',$id);
		return $this->fetchAll($select);
    }
    
	public function registraMessaggio($info)
	{
		$this->insert($info);
	}
	
	public function deleteMessaggioInviato($id)
	{
		$where = $this->getAdapter()->quoteInto('id_messaggio = ?', $id);
		$this->delete($where);
	}
    
}
?>