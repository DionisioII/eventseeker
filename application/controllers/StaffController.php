<?php

class StaffController extends Zend_Controller_Action
{
	protected $_eventModel;
	protected $_authService;
	protected $_cambioprofiloForm;
	protected $_aggiungieventoForm;
	protected $_cambiaeventoForm;
	protected $_aggiungiTipologiaForm;
	protected $_modificaTipologiaForm;
	protected $_adminModel;
	
	public function init()
	{
		$this->_authService = new Application_Service_Auth();
		$role=$this->_authService->getIdentity()->role;
		if ($role=='staff') {$this->_helper->layout->setLayout('stafflayout');}
		else {$this->_helper->layout->setLayout('adminlayout');}
		$this->_eventModel=new Application_Model_Event();
		$this->view->cambioprofiloForm = $this->getCambioprofiloForm();
		$this->view->aggiungieventoForm = $this->getAggiungieventoForm();
		$this->view->cambiaeventoForm = $this->getCambiaeventoForm();
		$this->view->aggiungiTipologiaForm = $this->getAggiungiTipologiaForm();
		$this->view->modificaTipologiaForm = $this->getModificaTipologiaForm();
		$this->_adminModel= new Application_Model_Admin();
		
	}
	
	public function indexAction()
	{
		$id=$this->_authService->getIdentity()->usrId;
		$staff=$this->_adminModel->getUserById($id);
		$this->view->assign(array(
				'Staff'=> $staff)
				)	;
	}
	
	public function getCambioprofiloForm()
    {
    		$urlHelper = $this->_helper->getHelper('url');
			$usrId=$this->_authService->getIdentity()->usrId;
		$this->_cambioprofiloForm = new Application_Form_Staff_Cambioprofilo();
    		$this->_cambioprofiloForm->setAction($urlHelper->url(array(
    			'usrId'=>$usrId,
				'controller' => 'staff',
				'action' => 'validatecambioprofilo'),
				'default'
		));
		return $this->_cambioprofiloForm;
    }
	
	public function getAggiungieventoForm()
    {
    		$urlHelper = $this->_helper->getHelper('url');
			$usrId=$this->_authService->getIdentity()->usrId;
		$this->_aggiungieventoForm = new Application_Form_Staff_Aggiungievento();
		$this->_aggiungieventoForm->setMethod('post');
    		$this->_aggiungieventoForm->setAction($urlHelper->url(array(
    			
				'controller' => 'staff',
				'action' => 'validateaggiungievento'),
				'default'
		));
		return $this->_aggiungieventoForm;
    }   
	
	public function getCambiaeventoForm()
    {
    		$urlHelper = $this->_helper->getHelper('url');
			$usrId=$this->_authService->getIdentity()->usrId;
		$this->_cambiaeventoForm = new Application_Form_Staff_Aggiungievento();
    		$this->_cambiaeventoForm->setAction($urlHelper->url(array(
    			
				'controller' => 'staff',
				'action' => 'validatecambiaevento'),
				'default'
		));
		return $this->_cambiaeventoForm;
    }  

		
	public function getAggiungiTipologiaForm()
    {
    		$urlHelper = $this->_helper->getHelper('url');
			//$usrId=$this->_authService->getIdentity()->usrId;
		$this->_aggiungiTipologiaForm = new Application_Form_Staff_AggiungiTipologia();
    		$this->_aggiungiTipologiaForm->setAction($urlHelper->url(array(
    			
				'controller' => 'staff',
				'action' => 'validateAggiungiTipologia'),
				'default'
		));
		return $this->_aggiungiTipologiaForm;
    }  


	public function getModificaTipologiaForm()
    {
    		$urlHelper = $this->_helper->getHelper('url');
			
		$this->_modificaTipologiaForm = new Application_Form_Staff_AggiungiTipologia();
    		$this->_modificaTipologiaForm->setAction($urlHelper->url(array(
    			
				'controller' => 'staff',
				'action' => 'validatemodificatipologia'),
				'default'
		));
		return $this->_modificaTipologiaForm;
    }   
	
	
	public function logoutAction()
	{
		$this->_authService->clear();
		return $this->_helper->redirector('index','public');	
	}
	

	public function cambioprofiloAction()
    {
    	
    	
		$usrId=$this->_authService->getIdentity()->usrId;
		$this->view->assign(array('usrId'=>$usrId
            		)
        );
		
    } 
	
	public function validatecambioprofiloAction()
    {
    	$request=$this->getRequest();
    	$pass=$this->getParam('pass');
		$conf_pass=$this->getParam('conf_pass');
		if($pass==$conf_pass)
		{
			$info=array(
	  		
   			"passwd" => $pass,
    		"name" => $request->getParam('nome'),
    		"surname"   => $request->getParam('cognome'));
			
			$echo='Il cambio dati è andato abuon fine';
			$usrId=$request->getParam('usrId');
			$this->_adminModel->changeUser($info,$usrId);
		}
		else 
			{
				$echo='Il cambio dati non è andato a buon fine';
			}
		$this->view->assign(array('Echo'=>$echo));
            		    
		
		
	    } 		
	

	public function visualizzamessaggiAction()
	{
		$usrId=$this->_authService->getIdentity()->usrId;
		$messaggi=$this->_adminModel->getMessagesByUserId($usrId);
		$this->view->assign(array(
            		'Messaggi'=>$messaggi
            		)
        );
	}
	
	public function gestiscieventiAction()
	{
		$events=$this->_eventModel->getEvents();
		//$categories=$this->_eventModel->getCats();
		$this->view->assign(array(
		'Events'=> $events
		/*'Categories'=>$categories*/));
	}
	
	public function aggiungieventoAction()
	{
		
		 
		
	}
	public function cancellaeventoAction()
	{
		$this->_helper->viewRenderer->setNoRender();
		$event_id=$this->getRequest()->getParam('event_id');
		$this->_eventModel->deleteEventById($event_id);
		$this->_eventModel->deleteBigliettoByEventID($event_id);
		$this->_helper->redirector('gestiscieventi');
	}
	
	public function cancellatipologiaAction()
	{
		$this->_helper->viewRenderer->setNoRender();
		$id_ticket=$this->getRequest()->getParam('id_ticket');
		$this->_eventModel->deleteBigliettoById($id_ticket);
		$this->_helper->redirector('gestiscieventi');
	}
	
	public function modificatipologiaAction()
	{
		$idTicket=$this->getParam('id_ticket');
		$biglietto=$this->_eventModel->getBigliettoById($id_ticket);
		$form=$this->_modificaTipologiaForm;
		$form->sezione->setValue($biglietto->sezione);
		$form->prezzo->setValue($biglietto->prezzo);
		$form->num_max->setValue($biglietto->num_max);
	}
	
	function convertiData($date)
							{
							$rsl = explode ('-',$date);
							$rsl = array_reverse($rsl);
							return implode($rsl,'/');
							}
	
	
	public function modificaeventoAction()
	{
		
		$eventID=$this->getParam('event_id');
		$event=$this->_eventModel->getEventsById($eventID);
		$form=$this->_cambiaeventoForm;
		
		$form->name->setValue($event->name);
		$form->start_time->setValue($event->start_time);
		$form->date->setValue($this->convertiData($event->date));
		$form->location->setValue($event->location);
		$form->description->setValue($event->description);		
		$form->add->setLabel('cambia');
		
	}
	
	public function aggiungitipobigliettoAction()
	{
		
		
		
	}
	
	
	public function validateaggiungieventoAction()
	{
		$this->_helper->viewRenderer->setNoRender();
		
		if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
		$form=$this->_aggiungieventoForm;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('aggiungievento');
        }
        $Values = $form->getValues();
		$this->_eventModel->insertEvent($Values);
		$this->_helper->redirector('gestiscieventi');
	}
	
	public function validatecambiaeventoAction()
	{
		$this->_helper->viewRenderer->setNoRender();
		$event_id=$this->_getParam('event_id');
		if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
		$form=$this->_cambiaeventoForm;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('modificaevento');
        }
        $Values = $form->getValues();

		
		$this->_eventModel->updateEventById($Values,$event_id);
		$this->_helper->redirector('gestiscieventi');
		
	}
	
	public function validateaggiungitipologiaAction()
	{
		$this->_helper->viewRenderer->setNoRender();
		$event_id=$this->_getParam('event_id');
		if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
		$form=$this->_aggiungiTipologiaForm;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('aggiungitipobiglietto');
        }
        $Values = $form->getValues();
		$Values['id_event']=$event_id;
		
		$this->_eventModel->insertBiglietto($Values);
		$this->_helper->redirector('gestiscieventi');
	}

	public function validatemodificatipologiaAction()
	{
		$this->_helper->viewRenderer->setNoRender();
		$event_id=$this->_getParam('event_id');
		$id_ticket=$this->_getParam('id_ticket');
		if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
		$form=$this->_modificaTipologiaForm;;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('modificatipologia');
        }
        $Values = $form->getValues();
		if (is_float($Value['prezzo']))
			 for( $i=0;$Value['prezzo'][$i];$i++)
					if($Value['prezzo'][$i]==',') $Value['prezzo'][$i]='.'		;
		$Values['id_event']=$event_id;
		
		$this->_eventModel->updateBiglietto($Values,$id_ticket);
		$this->_helper->redirector('gestiscieventi');
	}
	


}
