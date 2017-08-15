<?php

class AdminController extends Zend_Controller_Action
{
	protected $_eventModel;
	protected $_authService;
	protected $_userform ;
	protected $_modificaUserform ;
	protected $_categoryform ;
	protected $_changeCategoryform ;
	protected $_aggiungifaqform ;
	protected $_modificafaqform ;
	protected $_adminModel;
	protected $_datefilterForm;
	
	public function init()
	{
		$this->_helper->layout->setLayout('adminlayout');
		$this->_eventModel=new Application_Model_Event();
		$this->_authService = new Application_Service_Auth();
        //$this->view->loginForm = $this->getLoginForm();
		$this->view->userForm=$this->getUserForm();
		$this->view->modificaUserForm=$this->getmodificaUserForm();
		$this->view->categoryForm=$this->getcategoryForm();
		$this->view->changeCategoryForm=$this->getchangeCategoryForm();
		$this->view->aggiungifaqForm=$this->getaggiungifaqForm();
		$this->view->modificafaqForm=$this->getmodificafaqForm();
		$this->view->datefilterForm=$this->getdatefilterForm();
		$this->_adminModel= new Application_Model_Admin();
	}
	
	
	public function getdatefilterForm()
    {
    		$urlHelper = $this->_helper->getHelper('url');
		$this->_datefilterForm = new Application_Form_Admin_Datefilter();
    		$this->_datefilterForm->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'statistiche'),
				'default'
		));
		return $this->_datefilterForm;
    } 
	public function getUserForm()
    {
    		$urlHelper = $this->_helper->getHelper('url');
		$this->_userform = new Application_Form_Admin_User();
    		$this->_userform->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'validateaggiungiutente'),
				'default'
		));
		return $this->_userform;
    }   
		  
	public function getmodificaUserForm()
    {
    		$urlHelper = $this->_helper->getHelper('url');
		$this->_modificaUserform = new Application_Form_Admin_User();
    		$this->_modificaUserform->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'validatemodificautente'),
				'default'
		));
		return $this->_modificaUserform;
    } 
	
	public function getcategoryForm()
    {
    		$urlHelper = $this->_helper->getHelper('url');
		$this->_categoryform = new Application_Form_Admin_Category();
    		$this->_categoryform->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'validateaggiungicategoria'),
				'default'
		));
		return $this->_categoryform;
    }
	
	public function getchangeCategoryForm()
    {
    		$urlHelper = $this->_helper->getHelper('url');
		$this->_changeCategoryform = new Application_Form_Admin_Category();
    		$this->_changeCategoryform->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'validatemodificacategoria'),
				'default'
		));
		return $this->_changeCategoryform;
    }   
	
	public function getaggiungifaqForm()
    {
    		$urlHelper = $this->_helper->getHelper('url');
		$this->_aggiungifaqform = new Application_Form_Admin_Faq();
    		$this->_aggiungifaqform->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'validateaggiungifaq'),
				'default'
		));
		return $this->_aggiungifaqform;
    } 
	
	public function getmodificafaqForm()
    {
    		$urlHelper = $this->_helper->getHelper('url');
		$this->_modificafaqform = new Application_Form_Admin_Faq();
    		$this->_modificafaqform->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'validatemodificafaq'),
				'default'
		));
		return $this->_modificafaqform;
    }
	
	public function indexAction()
	{
		$id=$this->_authService->getIdentity()->usrId;
		$admin=$this->_adminModel->getUserById($id);
		$this->view->assign(array(
				'Admin'=> $admin)
				)	;
	}
	
	
	
	public function logoutAction()
	{
		$this->_authService->clear();
		return $this->_helper->redirector('index','public');	
	}
	

	// Zona gestione user
	public function gestisciaccountAction()
	{
		$users=$this->_adminModel->getUsers();
		$this->view->assign(array(
		'Users'=>$users));
	}	
	
	public function eliminautenteAction()
	{
		$this->_helper->viewRenderer->SetNoRender();
		$user=$this->getRequest()->getParam('user_id');
		$this->_adminModel->deleteUserById($user);
		$this->_helper->redirector('gestisciaccount');
	}

	public function modificautenteAction()
	{
		$userID=$this->getParam('user_id');
		$user=$this->_adminModel->getUserById($userID);
		$form=$this->_modificaUserform;
		$form->username->setValue($user->username);
		$form->name->setValue($user->name);
		$form->surname->setValue($user->surname);
		$form->role->setValue($user->role);
		
		$form->passwd->setValue($user->passwd);
		$form->conf_password->setValue($user->passwd);
		
		$form->aggiungi->setLabel('cambia');
		
	}
	
	public function aggiungiutenteAction()
	{
		
	}
	
	public function aggiungifaqAction()
	{
		
	}
	
	public function validateaggiungiutenteAction()
	{
		$this->_helper->viewRenderer->setNoRender();
		
		if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
		$form=$this->_userform;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('aggiungiutente');
        }
        $Values = $form->getValues();
		$this->_adminModel->saveUser($Values);
		$this->_helper->redirector('gestisciaccount'); 
	}

	public function validatemodificautenteAction()
	{
		$this->_helper->viewRenderer->SetNoRender();
		$user_id=$this->getRequest()->getParam('user_id');
		if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
		$form=$this->_userform;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('aggiungiutente');
        }
        $Values = $form->getValues();

		
		$this->_adminModel->changeUser($Values,$user_id);
		$this->_helper->redirector('gestisciaccount');
		
	}	

	
	//fine gestione user
	
	// SEZIONE TIPOLOGIE CATEGORIE
	
	public function gestiscicategorieAction()
	{
		$categorie=$this->_eventModel->getCats();
		$this->view->assign(array(
		'Categorie'=> $categorie));
	}
	
	public function aggiungicategoriaAction()
	{
		
	}
	public function validateaggiungicategoriaAction()
	{
		$form=$this->_categoryform;
		if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
		
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('aggiungicategoria');
        }
        $Values = $form->getValues();

		$this->_eventModel->insertcategory($Values);
		$this->_helper->redirector('gestiscicategorie');
		
	}  
	
	public function cancellacategoriaAction()
	{
		$this->_helper->viewRenderer->SetNoRender();
		$category=$this->getRequest()->getParam('catId');
		$this->_eventModel->deleteCategoryById($category);
		$this->_eventModel->deleteEventsByCategoryID($category);
		$this->_helper->redirector('gestiscicategorie');
	}
	
	public function cancellafaqAction()
	{
		$this->_helper->viewRenderer->SetNoRender();
		$faq=$this->getRequest()->getParam('id_faq');
		$this->_eventModel->deleteFaqById($faq);
		$this->_helper->redirector('gestiscifaq');
	}
	 
	 
	public function modificacategoriaAction()
	{
		$categoryID=$this->getParam('catId');
		$category=$this->_eventModel->getCatById($categoryID);
		$form=$this->_changeCategoryform;
		$form->name->setValue($category->name);
		$form->desc->setValue($category->desc);
		$form->aggiungi->setLabel('cambia');
	}
	
	public function modificafaqAction()
	{
		$faqID=$this->getParam('id_faq');
		$faq=$this->_eventModel->getFaqById($faqID);
		$form=$this->_modificafaqform;
		$form->question->setValue($faq->question);
		$form->answer->setValue($faq->answer);
		$form->aggiungi->setLabel('cambia');
	}
	
	public function validatemodificacategoriaAction()
	{
		$this->_helper->viewRenderer->SetNoRender();
		$category_id=$this->getRequest()->getParam('catId');
		$form=$this->_changeCategoryform;
		if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
		
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('modificacategoria');
        }
        $Values = $form->getValues();
		
		$this->_eventModel->changeCategoryById($Values,$category_id);
		$this->_helper->redirector('gestiscicategorie');
	}
	
	
	public function statisticheAction()
	{
		$form=$this->_datefilterForm;
        
		
		$events=$this->_eventModel->getEvents();
		
		$date=$this->getParam('date1',null);
		if($date!=NULL){
		if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
			$events=$this->_eventModel->getEvents();
			$this->view->assign(array(
		'Events'=>$events
		));
            return $this->render('statistiche');
        }
		else{
		$date1=$form->getValue('date1');
		$date2=$form->getValue('date2');
		$events=$this->_eventModel->getEventsByDates($date1,$date2);}
		
		}
		
		$this->view->assign(array(
		'Events'=>$events
		));
	}
	
	public function gestiscifaqAction()
	{
		$faqs=$this->_eventModel->getFaqs();
		$this->view->assign(array(
		'Faqs'=>$faqs));
	}
	
	public function validateaggiungifaqAction ()
	{
		$this->_helper->viewRenderer->setNoRender();
		
		if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
		$form=$this->_aggiungifaqform;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('aggiungifaq');
        }
        $Values = $form->getValues();
				
		$this->_eventModel->insertFaq($Values);
		$this->_helper->redirector('gestiscifaq');
	}
	
	public function validatemodificafaqAction()
	{
		$this->_helper->viewRenderer->setNoRender();
		$id_faq=$this->_getParam('id_faq');
		if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
		$form=$this->_modificafaqform;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('modificafaq');
        }
        $Values = $form->getValues();
		$Values['id_faq']=$id_faq;
		
		$this->_eventModel->updateFaqById($Values,$id_faq);
		$this->_helper->redirector('gestiscifaq');
	}
	
	public function storicoutenteAction()
	{
		$utenti=$this->_adminModel->getUtenti();
		$this->view->assign(array(
		'Utenti'=>$utenti));
	}
	
	
	
	
	





}