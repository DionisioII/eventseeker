<?php

class UserController extends Zend_Controller_Action
{
	protected $_eventModel;
	protected $_authService;
	protected $_form ;
	protected $_adminModel;
	protected $_messaggioForm;
	protected $_cambioProfiloForm;
	protected $_replyMessaggioForm;
	protected $_numbervalidator;
	
	
	public function init()
	{
		$this->_authService = new Application_Service_Auth();
		$role=$this->_authService->getIdentity()->role;
		if ($role=='user') {$this->_helper->layout->setLayout('userlayout');}
			
		elseif($role=='staff') {$this->_helper->layout->setLayout('stafflayout');}
		else {$this->_helper->layout->setLayout('adminlayout');}
		
		$this->_eventModel=new Application_Model_Event();
		$this->_adminModel=new Application_Model_Admin();
		
        $this->_postaModel= new Application_Model_Posta();
		$this->view->prenotazioneForm = $this->getPrenotazioneForm();
		$this->view->cambioprofiloForm = $this->getCambioprofiloForm();
		$this->view->messaggioForm = $this->getMessaggioForm();
		$this->view->replymessaggioForm = $this->getReplyMessaggioForm();
		$this->_numbervalidator=new Zend_Validate_Digits();
	}
	
	public function indexAction()
	{
		//$id=$this->_authService->getIdentity()->usrId;
		$user=$this->_authService->getIdentity();
		$this->view->assign(array(
				'User'=> $user)
				)	;
	}
	
	public function oureventsAction()
	{
		$cats=$this->_eventModel->getCats();
		
		$this->view->assign(array(
				'Categories'=> $cats)
				)	;
	}
	
	
	
	
	public function logoutAction()
	{
		$this->_authService->clear();
		return $this->_helper->redirector('index','public');	
	}
	
	
	public function validateprenotazioneAction()
    {
      
       $this->_helper->viewRenderer->setNoRender();
		
		    if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
		$id_Event=$this->_getParam('event_id');
		$form=$this->_form;
        if (!$form->isValid($_POST)) {
        	
			$tip_eventi=$this->_eventModel->getBigliettiById($id_Event);
		    $tip_sezioni;
		    foreach ($tip_eventi as $tip_evento) { $tip_sezioni[$tip_evento->sezione]=$tip_evento->sezione;	}
			$form->sezione->setMultiOptions($tip_sezioni);
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
			$this->view->prenotazioneForm=$form;
            return $this->render('prenota');
        }
		$nameEvent=$this->_getParam('nameEvent');
		$date=$this->_getParam('dateEvent');
		$usrId=$this->_getParam('usrId');
		$catId=$this->_getParam('Category');
		$values = $form->getValues();
		$num_biglietti=$form->getValue('num_biglietti');
		$price;
		$string=$values['sezione'];
		$pricerow= $this->_eventModel->getBigliettoByIdAndSezione($id_Event,$string);
		$price=$pricerow->prezzo*$num_biglietti;
		$controllo=$pricerow->cont_num + $num_biglietti;
		if($controllo>$pricerow->num_max)
			{
				$tip_eventi=$this->_eventModel->getBigliettiById($id_Event);
		    $tip_sezioni;
		    foreach ($tip_eventi as $tip_evento) { $tip_sezioni[$tip_evento->sezione]=$tip_evento->sezione;	}
			$form->sezione->setMultiOptions($tip_sezioni);
			$echo=$pricerow->num_max - $pricerow->cont_num;
            $form->setDescription('Attenzione: rimangono solo '.$echo.' biglietti');
			$this->view->prenotazioneForm=$form;
            return $this->render('prenota');
        
			}
		$values['UsrId']=$usrId;	
		$values['catId']=$catId;
		$values['evento']=$nameEvent;
		$values['date']=$date;
		$values['prezzo']=$price;
        $idTicket=$pricerow->id_ticket;
       	$this->_eventModel->prenotaEvento($values);
		$this->_eventModel->aggiornaContatore($idTicket,$num_biglietti);
		$this->_helper->redirector('visualizzaPrenotazioni'); 
        
		
        
    }
	
	
	public function getPrenotazioneForm()
    {
    		$urlHelper = $this->_helper->getHelper('url');
			$usrId=$this->_authService->getIdentity()->usrId;
		$this->_form = new Application_Form_User_Prenotazione();
		$this->_form->setMethod('post');
    		$this->_form->setAction($urlHelper->url(array(
				'controller' => 'user',
				'action' => 'validateprenotazione',
				'usrId'=>$usrId),
				'default'
		));
		return $this->_form;
    }   
	

	public function prenotaAction()
    {
    	
    	$nameEvent = $this->_getParam('nameEvent');
		$catId=$this->_getParam('Category');
		$dateEvent=$this->_getParam('dateEvent');
		$id_Event=$this->_getParam('event_id');
		$usrId=$this->_authService->getIdentity()->usrId;
		$tip_eventi=$this->_eventModel->getBigliettiById($id_Event);
		$tip_sezioni;
		foreach ($tip_eventi as $tip_evento) { $tip_sezioni[$tip_evento->sezione]=$tip_evento->sezione;	}
		$this->view->prenotazioneForm->sezione->setMultiOptions($tip_sezioni);
		$this->view->assign(array(
					'Category'=>$catId,
            		'nameEvent' => $nameEvent,
    				'dateEvent'=>$dateEvent,
    				'usrId'=>$usrId
            		)
        );
		
    }
	
	public function visualizzaprenotazioniAction()
	{
		$usrId=$this->getParam('user_id');
		if(!isset($usrId)){
		$usrId=$this->_authService->getIdentity()->usrId;}
		$prenotazioni=$this->_eventModel->visualizzaEventiByUserId($usrId);
		$this->view->assign(array(
            		'Prenotazioni' => $prenotazioni)
        );
	}
	
	public function getCambioprofiloForm()
    {
    		$urlHelper = $this->_helper->getHelper('url');
			$usrId=$this->_authService->getIdentity()->usrId;
		$this->_cambioProfiloForm = new Application_Form_User_Cambioprofilo();
    		$this->_cambioProfiloForm->setAction($urlHelper->url(array(
    			'usrId'=>$usrId,
				'controller' => 'user',
				'action' => 'validatecambioprofilo'),
				'default'
		));
		return $this->_cambioProfiloForm;
    }  
	
	public function cambioprofiloAction()
    {
    	
    	
		$usrId=$this->_authService->getIdentity()->usrId;
		$user=$this->_adminModel->getUserById($usrId);
		$form=$this->_cambioProfiloForm;
		$form->username->setValue($user->username);
		$form->name->setValue($user->name);
		$form->surname->setValue($user->surname);
		$form->passwd->setValue($user->passwd);
		$form->conf_pass->setValue($user->passwd);
		$this->view->assign(array('usrId'=>$usrId
            		)
        );
		
    } 
	
	public function validatecambioprofiloAction()
    {
    	$request=$this->getRequest();
    	$this->_helper->viewRenderer->setNoRender();
		if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
		$form=$this->_cambioProfiloForm;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
			
				
            return $this->render('cambioprofilo');
        }
		
		$values=$form->getValues();
		unset($values['conf_pass']);
        $usrId=$request->getParam('usrId');
		$this->_adminModel->changeUser($values,$usrId);
		$this->_helper->redirector('index');   		    
		
		
	    } 		
	
	
	/* sezione azioni modelli */
	
	public function eventsAction()
	{
		$category=$this->getParam('category');
		$paged = $this->_getParam('page', 1);
		$catName=$this->_eventModel->getCatById($category);
		$events=$this->_eventModel->getEventsByCat_id($category,$paged);
		$this->view->assign(array(
		'Category'=>$category,
		'Events'=>$events,
		'CatName'=>$catName->name));
	}
	
	
/*fine sezione azione modelli */

	public function visualizzamessaggiricevutiAction()
	{
		$usrId=$this->_authService->getIdentity()->usrId;
		$role=$this->_authService->getIdentity()->role;
		$messaggi=$this->_postaModel->getMessaggiRicevutiById($usrId,$role);
		$this->view->assign(array(
            		'Messaggiricevuti'=>$messaggi
            		)
        );
	}
	
	public function displaymessageAction()
	{
		$id_messaggio=$this->getParam('message_id');
		$ricevuto=$this->getParam('ricevuto');
		$messaggio=$this->_postaModel->getMessaggioById($id_messaggio);
		$this->view->assign(array(
            		'Messaggio'=>$messaggio,
            		'Ricevuto'=>$ricevuto
            		)
					);
	}
	
	public function visualizzamessaggiinviatiAction()
	{
		$usrId=$this->_authService->getIdentity()->usrId;
		$messaggi=$this->_postaModel->getMessaggiInviatiById($usrId);
		$this->view->assign(array(
            		'Messaggiinviati'=>$messaggi
            		)
        );
	}
	
 	public function inviamessaggioAction()
 	{
 		
		
 	}
	
	public function replyAction()
	{
		$id=$this->getParam('usrId_send');
		$username=$this->_adminModel->getUserById($id)->username;
		$this->_replyMessaggioForm->role->setMultiOptions(array($id =>$username));
		
	}
	
	
	public function getMessaggioForm()
    {
    		$urlHelper = $this->_helper->getHelper('url');
			$role=$this->_authService->getIdentity()->role;
			$usrId=$this->_authService->getIdentity()->usrId;
			
		$this->_messaggioForm = new Application_Form_User_Messaggio();
		if($role=='staff'){
			$users=$this->_adminModel->getUtenti();
			$utenti['user']='user';
			foreach ($users as $user) {
				$utenti[$user->usrId]=$user->username;
			}
			$this->_messaggioForm->role->setMultiOptions($utenti);}
    	$this->_messaggioForm->setAction($urlHelper->url(array(
    			'usrId'=>$usrId,
				'controller' => 'user',
				'action' => 'validatemessaggio'),
				'default'
		));
		return $this->_messaggioForm;
    }  
	public function getReplyMessaggioForm()
	{
    		$urlHelper = $this->_helper->getHelper('url');
			$usrId=$this->_authService->getIdentity()->usrId;
		$this->_replyMessaggioForm = new Application_Form_User_Replymessaggio();
    		$this->_replyMessaggioForm->setAction($urlHelper->url(array(
    			'usrId'=>$usrId,
				'controller' => 'user',
				'action' => 'validatereply'),
				'default'
		));
		return $this->_replyMessaggioForm;
    }  
	
	public function validatemessaggioAction()
	{
		$this->_helper->viewRenderer->setNoRender();
		if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
		$form=$this->_messaggioForm;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
			
				
            return $this->render('inviamessaggio');
        }
		$usrId=$this->_authService->getIdentity()->usrId;
		$values=$form->getValues();
		
		
		
		$values['usrId_send']=$usrId;
		
		$this->_postaModel->inviaMessaggio($values);
		$this->_postaModel->registraMessaggio($values);
		$this->_helper->redirector('visualizzamessaggiinviati');
	}
	
	public function validatereplyAction()
	{
		$this->_helper->viewRenderer->setNoRender();
		if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
		$form=$this->_replyMessaggioForm;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
			//$this->_replyMessaggioForm->role->setMultiOptions(array($id =>'staff'));
				
            return $this->render('reply');
        }
		$usrId=$this->_authService->getIdentity()->usrId;
		
		$values=$form->getValues();
		$values['usrId_send']=$usrId;
		
		
		
		$this->_postaModel->inviaMessaggio($values);
		$this->_postaModel->registraMessaggio($values);
		$this->_helper->redirector('visualizzamessaggiinviati');
	}
	
	public function deletemessageAction()
	{
		$this->_helper->viewRenderer->setNoRender();
		$id=$this->getParam('IdMessage');
		$ricevuto=$this->getParam('Ricevuto');
		if($ricevuto==TRUE) {$this->_postaModel->deleteMessaggioRicevuto($id); $this->_helper->redirector('visualizzamessaggiricevuti');}
		else  $this->_postaModel->deleteMessaggioInviato($id); $this->_helper->redirector('visualizzamessaggiinviati');
	}
	
	public function searchAction()
	{
		
		$search=$this->getParam('search');
	   $mese=$this->getParam('mese');
	   $location=$this->getParam('location');
	   $anno=$this->getParam('anno');
		$events=$this->_eventModel->getEventsBySearch($search,$mese,$location,$anno);
		
		
		$this->view->assign(array(
		
		'Events'=>$events,
		'search'=>$search
		
		));
	}
	
	public function searchviewAction()
	{
		
       $id=$this->getParam('view_id');
	  
		
		$event=$this->_eventModel->getEventsById($id);
		
		
		$this->view->assign(array(
		
		'event'=>$event,
		
		));
	}
	
	function convertiData($date)
							{
							$rsl = explode ('-',$date);
							$rsl = array_reverse($rsl);
							return implode($rsl,'/');
							}
	
	public function stampaAction()
	{
		$this->_helper->layout()->disableLayout();
		//$this->_helper->viewRenderer->setNoRender();
		// Load Zend_Pdf class 
		$id=$this->getParam('id_prenotazione');
		$prenotazione=$this->_eventModel->getRowByID($id);
		$data=$this->convertiData($prenotazione->date);
		Zend_Loader::loadClass('Zend_Pdf');
		$pdf = new Zend_Pdf();
		$page = $pdf->newPage(Zend_Pdf_Page::SIZE_A4); 
		$page->setFont(Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA),18);
		$page->drawText($prenotazione->evento.'  '.$data, 100, 570); 
		$page->drawText('tipologia: '.$prenotazione->sezione, 100, 540);
		$page->drawText('numero di biglietti: '.$prenotazione->num_biglietti, 100, 510);
		$pdf->pages[] = $page;
		$pdfData = $pdf->render();
		$this->view->assign(array(
		
		'pdfData'=>$pdfData	
		
		));
		
	}


}
