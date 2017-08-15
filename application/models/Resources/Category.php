<?php
    class Application_Resource_Category extends Zend_Db_Table_Abstract
{
    protected $_name    = 'category';
    protected $_primary  = 'catId';
    protected $_rowClass = 'Application_Resource_Category_Item';
    
	public function init()
    {
    }

    public function getCatById($id)
    {
        return $this->find($id)->current();
    }
    
    public function getCats()
    {
		$select = $this->select();
        return $this->fetchAll($select);
    }
	
	public function insertCategory($info)
	{
		return $this->insert($info);
	}
	
	public function deleteCategoryById($category_id)
	{
		$where = $this->getAdapter()->quoteInto('catId = ?', $category_id);
		$this->delete($where);
	}
	
	public function changeCategoryById($info,$category_id)
	{
		 $this->update( $info,'catId='.$category_id);
	}
}
?>