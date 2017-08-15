<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
protected $_logger;
	protected $_view;	
		
	protected function _init()
    {
        $this->bootstrap('frontController');
    }

    protected function _initLocale()
    {
        $locale = new Zend_Locale('en_US');
		Zend_Registry::set('Zend_Locale', $locale);
    }
    
    protected function _initLogging()
    {
        $logger = new Zend_Log();
        $writer = new Zend_Log_Writer_Firebug();
        $logger->addWriter($writer);
        $this->_logger = $logger;
        Zend_Registry::set('log', $logger);
    	$this->_logger->info('Bootstrap ' . __METHOD__);
    }

    protected function _initViewSettings()
    {
        $this->bootstrap('view');
        $this->_view = $this->getResource('view');
        $this->_view->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8');
        $this->_view->headMeta()->appendHttpEquiv('Content-Language', 'it-IT');
        $this->_view->headLink()->appendStylesheet('css/default.css');
								
        $this->_view->headTitle('EventSeeker');
    }
    
    protected function _initDefaultModuleAutoloader()
    {
    	$loader = Zend_Loader_Autoloader::getInstance();
		$loader->registerNamespace('App_');
        $this->getResourceLoader()
             ->addResourceType('modelResource','models/resources','Resource');  
    }

    protected function _initFrontControllerPlugin()
    {
    	$front = Zend_Controller_Front::getInstance();
    	$front->registerPlugin(new App_Controller_Plugin_Acl());
    }
    
	protected function _initDbParms()
    {
    	
		$db = new Zend_Db_Adapter_Pdo_Mysql(array(
    			'host'     => 'localhost',
    			'username' => 'username',
    			'password' => 'password',
    			'dbname'   => 'eventseeker'
				));  
		Zend_Db_Table_Abstract::setDefaultAdapter($db);
	}

}

