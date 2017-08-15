<?php

class App_Form_Element_SelectCategory extends Zend_Form_Element_Select
{
	public function init()
	{
		$model=new Application_Model_Event();
		$categories=$model->getCats();
		
		foreach($categories as $category)
			{
				$this->addMultiOption($category['name'],$category['catId']);
			}
	}
}
