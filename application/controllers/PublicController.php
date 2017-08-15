<?php

class PublicController extends Zend_Controller_Action
{
	protected $_eventModel;
	protected $_authService;
	protected $_form = null;
	
	protected $_registerform;
	protected $_adminModel;
	
	public function init()
	{
		$this->_eventModel=new Application_Model_Event();
		$this->_authService = new Application_Service_Auth();
		$this->_adminModel=new Application_Model_Admin();
		if(isset($this->_authService->getIdentity()->role)){
			$role=$this->_authService->getIdentity()->role;
			if ($role=='user') {$this->_helper->layout->setLayout('userlayout');}
			
			elseif($role=='staff') {$this->_helper->layout->setLayout('stafflayout');}
			elseif($role=='admin') {$this->_helper->layout->setLayout('adminlayout');}}
        $this->view->loginForm = $this->getLoginForm();
		$this->view->registerForm = $this->getRegisterForm();
		
		
	}
	
	public function indexAction()
	{
		
	}
	
	public function oureventsAction()
	{
		$cats=$this->_eventModel->getCats();
		
		$this->view->assign(array(
				'Categories'=> $cats)
				)	;
	}
	
	
	public function aboutusAction()
	{
		
	}
	
	public function contactusAction()
    {
        // action body
    }
	
	public function faqAction()
	{
		$faqs=$this->_eventModel->getFaqs();
		$this->view->assign(array(
		'Faqs'=>$faqs));
	}
	
	public function loginAction()
    {
    }
	
	public function authenticateAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $this->_helper->redirector('login');
        }
        $form = $this->_form;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
        	return $this->render('login');
        }
        if (false === $this->_authService->authenticate($form->getValues())) {
            $form->setDescription('Autenticazione fallita. Riprova');
            return $this->render('login');
        }
        return $this->_helper->redirector('index', $this->_authService->getIdentity()->role);
    }
	
	public function validateloginAction()
    {
        $this->_helper->getHelper('layout')->disableLayout();
    		$this->_helper->viewRenderer->setNoRender();

        $loginform = new Application_Form_Public_Auth_Login();
		$value=$this->_getParam('value');
		$response=$this->_adminModel->findUsername($value); 
        if ($response !== null) {
        	$this->getResponse()->setHeader('Content-type','application/json')->setBody($response);        	
        }
    }
	
	public function getRegisterForm()
    {
    		$urlHelper = $this->_helper->getHelper('url');
		$this->_registerform = new Application_Form_Public_Registration();
    		$this->_registerform->setAction($urlHelper->url(array(
				'controller' => 'public',
				'action' => 'validateregister'),
				'default'
		));
		return $this->_registerform;
    } 
	
	/*public function getSearchForm()
    {
    		$urlHelper = $this->_helper->getHelper('url');
		$this->_searchForm = new Application_Form_Public_Searchbar();
    		$this->_searchForm->setAction($urlHelper->url(array(
				'controller' => 'public',
				'action' => 'search'),
				'default'
		));
		return $this->_searchForm;
    } */
	
	public function getLoginForm()
    {
    		$urlHelper = $this->_helper->getHelper('url');
		$this->_form = new Application_Form_Public_Auth_Login();
    		$this->_form->setAction($urlHelper->url(array(
				'controller' => 'public',
				'action' => 'authenticate'),
				'default'
		));
		return $this->_form;
    } 
		
	
	public function eventsAction()
	{
		
		$category=$this->getParam('category',null);
		$paged = $this->_getParam('page', 1);
		
		$catName=$this->_eventModel->getCatById($category);
		$events=$this->_eventModel->getEventsByCat_id($category,$paged);
		
		
		$this->view->assign(array(
		'Category'=>$category,
		'Events'=>$events,
		'CatName'=>$catName->name));
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
	
		

	public function registerAction()
	{
	
	}
	
	public function validateregisterAction()
	{
		//$this->_helper->getHelper('layout')->disableLayout();
    		//$this->_helper->viewRenderer->setNoRender();
		if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
		$form=$this->_registerform;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
			
				
            return $this->render('register');
        }
		
		$values=$form->getValues();
		$response=$this->_adminModel->findUsername($values['username']); 
		 if ($response) {
            $form->setDescription('Attenzione: nome utente già utilizzato.');
			
				
            return $this->render('register');
        }
		
		
		$values['role']='user';
		$this->_adminModel->saveUser($values);
		 $this->_helper->redirector('index');
	}
	
	
	
	






}
