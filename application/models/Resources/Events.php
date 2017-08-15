<?php
    class Application_Resource_Events extends Zend_Db_Table_Abstract
{
    protected $_name    = 'events';
    protected $_primary  = 'event_id';
    protected $_rowClass = 'Application_Resource_Events_Item';
    
	public function init()
    {
    }

    public function getEventsById($id)
    {
        return $this->find($id)->current();
    }
    
    public function getEvents()
    {
		
        return $this->fetchAll();
    }
	
	function convertiData($dataEur)
	{
		$rsl = explode ('/',$dataEur);
		$rsl = array_reverse($rsl);
		return implode($rsl,'-');
	}
	
	public function getEventsByDates($date1,$date2)
	{
		$date1_formatted = $this->convertiData($date1);          
		$date2_formatted = $this->convertiData($date2);
		$select=$this->select()
					 ->from('events')
					 ->where('date >= ?',$date1_formatted)
					 ->where('date <= ?',$date2_formatted);
		
		return $this->fetchAll($select);
	}
	
	
	public function getEventsByCat_id($cat_id,$paged=null)
    {
		$select=$this->select()
					 ->from('events')
					 ->where('cat_id IN(?)',$cat_id);
		if (null !== $paged) {
			$adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage(1)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
		}
		return $this->fetchAll($select);
    }
	
	public function getEventsBySearch($search,$mese,$location,$anno)
	{
		$select;
		if ($mese=='tt'&& $location=='tt'){
		$select=$this->select()
					 ->from('events',array('event_id', 'cat_id', 'name','date','start_time','location','description','image'))
					 ->where('name LIKE ? OR location LIKE ? OR description LIKE ?','%'.$search.'%')
					 ->where('date LIKE ?',$anno.'%');
					 
					 }
		elseif($mese!=='tt'&& $location=='tt'){
		$select=$this->select()
					 ->from('events',array('event_id', 'cat_id', 'name','date','start_time','location','description','image'))
					 ->where('date LIKE ?',$anno.'-'.$mese.'%')
					  ->where('name LIKE ? OR location LIKE ? OR description LIKE ?','%'.$search.'%');
					 	
					}
		elseif($mese!=='tt'&& $location!=='tt'){
		$select=$this->select()
					 ->from('events',array('event_id', 'cat_id', 'name','date','start_time','location','description','image'))
					 ->where('date LIKE ?',$anno.'-'.$mese.'%')
					 ->where('location LIKE ?',$location)
					  ->where('name LIKE ? OR description LIKE ?','%'.$search.'%');
					
					}
		elseif($mese=='tt'&& $location!=='tt'){
		$select=$this->select()
					 ->from('events',array('event_id', 'cat_id', 'name','date','start_time','location','description','image'))
					 
					 ->where('location LIKE ?',$location)
					  ->where('name LIKE ? OR description LIKE ?','%'.$search.'%')
					 ->where('date LIKE ?',$anno.'%');
					}
					
		
		return $this->fetchAll($select);
	}	
	
	
	public function deleteEventById($event_id)
	{
		$where = $this->getAdapter()->quoteInto('event_id = ?', $event_id);
		$this->delete($where);
			 	
	}
	
	public function updateEventById($info,$event_id)
	{
		$info[date]=$this->convertiData($info[date]);
		$where = $this->getAdapter()->quoteInto('event_id = ?', $event_id);
		$this->update($info,$where);
			 	
	}
	
	public function insertEvent($info)
	{
		$info[date]=$this->convertiData($info[date]);
		$this->insert($info);
	}
	
	public function deleteEventsByCategoryID($id_category)
	{
		$where = $this->getAdapter()->quoteInto('cat_id= ?', $id_category);
		
			$this->delete($where);
	}
	
	
}
?>