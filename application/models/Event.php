<?php
    class Application_Model_Event extends App_Model_Abstract
{ 
	public function __construct()
    {
	}
	public function getCatById($id)
	{
		return $this->getresource('Category')->getCatById($id);
	}	
	
	public function getCats()
	{
		return $this->getresource('Category')->getCats();
	}	
	
	public function insertCategory($info)
	{
		return $this->getresource('Category')->insertCategory($info);
	}
	
	public function deleteCategoryById($category_id)
	{
		return $this->getresource('category')->deleteCategoryById($category_id);
	}
	
	public function changeCategoryById($info,$category_id)
	{
		return $this->getresource('Category')->changeCategoryById($info,$category_id);
	}
	
	
	
	public function getEvents()
	{
		return $this->getresource('Events')->getEvents();
	}
	
	public function getEventsById($id)
    {
        return $this->getresource('Events')->getEventsById($id);
    }
	
	public function getEventsByDates($date1,$date2)
	{
		return $this->getresource('Events')->getEventsByDates($date1,$date2);
	}
	
	
	public function getEventsByCat_id($cat_id,$paged)
	{
		return $this->getresource('Events')->getEventsByCat_id($cat_id,$paged);
	}
	
	public function getEventsBySearch($search,$mese,$location,$anno)
	{
		return $this->getresource('Events')->getEventsBySearch($search,$mese,$location,$anno);
	}	
	
	public function deleteEventById($event_id)
	{
		return $this->getresource('Events')->deleteEventById($event_id);
	}
	
	public function updateEventById($info,$event_id)
	{
		return $this->getresource('Events')->updateEventById($info,$event_id);
	}
	
	public function insertEvent($info)
	{
		return $this->getresource('Events')->insertEvent($info);
	}
	
	
	public function getFaqById($id)
	{
		return $this->getresource('Faq')->getFaqById($id);
	}
	
	
	public function getFaqs()
	{
		return $this->getresource('Faq')->getfaqs();
	}
	
	public function deleteFaqById($id_faq)
	{
		return $this->getresource('Faq')->deleteFaqById($id_faq);
	}
	
	public function insertFaq($info)
	{
		return $this->getresource('Faq')->insertFaq($info);
	}
	
	public function updateFaqById($info,$faq_id)
	{
		return $this->getresource('Faq')->updateFaqById($info,$faq_id);
	}
	
	public function prenotaEvento($info)
	{
		return $this->getresource('Prenotazione')->PrenotaEvento($info);
	}
	
	public function visualizzaEventiByUserId($id)
	{
		return $this->getresource('Prenotazione')->visualizzaEventiByUserId($id);
	}
	
	public function getRowByID($id)
	{
		return $this->getresource('Prenotazione')->getRowByID($id);
	}
	
	
	
	public function getPrice($id_event)
	{
		return $this->getresource('Biglietti')->getPrice($id_event);
	}
	
	public function getBigliettiById($id_event)
	{
		return $this->getresource('Biglietti')->getBigliettiById($id_event);
	}
	
	public function  getBigliettoById($id_ticket)
	{
		return $this->getresource('Biglietti')->getBigliettoById($id_ticket);
	}
	
	
	
	public function getBigliettoByIdAndSezione($id_event,$string)
	{
		return $this->getresource('Biglietti')->getBigliettoByIdAndSezione($id_event,$string);
	}

	public function aggiornaContatore($idTicket,$num_biglietti)
	{
		return $this->getresource('Biglietti')->aggiornaContatore($idTicket,$num_biglietti);
	}
	
	public function insertBiglietto($info)
	{
		return $this->getresource('Biglietti')->insertBiglietto($info);
	}
	
	public function updateBiglietto($info,$id_ticket)
	{
		return $this->getresource('Biglietti')->updateBiglietto($info,$id_ticket);
	}
	
	public function deleteBigliettoById($id_ticket)
	{
		return $this->getresource('Biglietti')->deleteBigliettoById($id_ticket);
	}
	
	public function deleteBigliettoByEventID($id_event)
	{
		return $this->getresource('Biglietti')->deleteBigliettoByEventID($id_event);
	}
	
	public function deleteEventsByCategoryID($id_category)
	{
		return $this->getresource('Events')->deleteEventsByCategoryID($id_category);
	}
}
?>