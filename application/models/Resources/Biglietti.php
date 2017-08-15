<?php
    class Application_Resource_Biglietti extends Zend_Db_Table_Abstract
{
    protected $_name    = 'biglietti';
    protected $_primary  = 'id_ticket';
    protected $_rowClass = 'Application_Resource_Biglietti_Item';
    
	public function init()
    {
    }
	
	public function getBigliettoById($id_ticket)
	{
		$select=$this->select()
					 ->from('biglietti')
					 ->where('id_ticket IN(?)',$id_ticket);
		return $this->fetchRow($select);
	}
	
	public function insertBiglietto($info)
	{
		$this->insert($info);
	}
	
	public function deleteBigliettoById($id_ticket)
	{
		$where = $this->getAdapter()->quoteInto('id_ticket= ?', $id_ticket);
		$this->delete($where);
	}
	
	public function deleteBigliettoByEventID($id_event)
	{
		$where = $this->getAdapter()->quoteInto('id_event= ?', $id_event);
		
			$this->delete($where);
		
		
	}
	public function updateBiglietto($info,$id_ticket)
	{
	$where = $this->getAdapter()->quoteInto('id_ticket = ?', $id_ticket);
		$this->update($info,$where);
	}
	
	public function getBigliettiById($id_event)
	{
		$select=$this->select()
					 ->from('biglietti')
					 ->where('id_event IN(?)',$id_event);
		return $this->fetchAll($select);
	}
	
	public function getBigliettoByIdAndSezione($id_event,$string)
	{
		$select=$this->select()
					 ->from('biglietti')
					 ->where('id_event IN(?)',$id_event)
					 ->where('sezione IN(?)',$string);
		return $this->fetchRow($select);
	}
	
	public function aggiornaContatore($idTicket,$num_biglietti)
	{
		$select=$this->select()
					 ->from('biglietti')
					 ->where('id_ticket IN(?)',$idTicket);
		$row=$this->fetchRow($select);
		$array['id_ticket']=$row->id_ticket;
		$array['id_event']=$row->id_event;
		$array['sezione']=$row->sezione;
		$array['prezzo']=$row->prezzo;
		
		$array['cont_num']=$row->cont_num+$num_biglietti;
		$array['num_max']=$row->num_max;
		$cont_num=$row['cont_num'];
		$cont_num=$cont_num +$num_biglietti;
		$where = $this->getAdapter()->quoteInto('id_ticket = ?', $idTicket);
		$this->update($array,$where);
					 
	}
}