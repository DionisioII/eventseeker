<?php

class Application_Model_Posta extends App_Model_Abstract
{ 

	public function __construct()
    {
    }
	
	public function getMessaggiInviatiById($id)
	{
		return $this->getresource('Messaggiinviati')->getMessaggiInviatiById($id);
	}
	
	public function getMessaggiRicevutiById($id,$role=null)
	{
		return $this->getresource('Messaggiricevuti')->getMessaggiRicevutiById($id,$role);
	}
	
	public function getMessaggioById($id_messaggio)
	{
		return $this->getresource('Messaggiricevuti')->getMessaggioById($id_messaggio);
	}
	
	public function inviaMessaggio($info)
	{
		return $this->getresource('Messaggiricevuti')->inviaMessaggio($info);
	}
	
	public function registraMessaggio($info)
	{
		return $this->getresource('Messaggiinviati')->registraMessaggio($info);
	}
	
	public function deleteMessaggioRicevuto($id)
	{
		return $this->getresource('Messaggiricevuti')->deleteMessaggioRicevuto($id);
	}
	
	public function deleteMessaggioInviato($id)
	{
		return $this->getresource('Messaggiinviati')->deleteMessaggioInviato($id);
	}
	
	
	
}
?>