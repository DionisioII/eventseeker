<?php
    class Application_Resource_Faq extends Zend_Db_Table_Abstract
{
    protected $_name    = 'faq';
    protected $_primary  = 'id_faq';
    protected $_rowClass = 'Application_Resource_Faq_Item';
    
	public function init()
    {
    }

    public function getFaqById($id)
    {
        return $this->find($id)->current();
    }
    
    public function getFaqs()
    {
		$select = $this->select();
        return $this->fetchAll($select);
    }
	
	public function deleteFaqById($id_faq)
	{
		$where = $this->getAdapter()->quoteInto('id_faq = ?', $id_faq);
		$this->delete($where);
	}
	
	public function updateFaqById($info,$faq_id)
	{
		$where = $this->getAdapter()->quoteInto('id_faq = ?', $faq_id);
		$this->update($info,$where);
			 	
	}
	
	public function insertFaq($info)
	{
		$this->insert($info);
	}
	
}
?>