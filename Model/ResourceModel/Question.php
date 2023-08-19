<?php
namespace Custom\FAQ\Model\ResourceModel;


class Question extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	protected function _construct()
	{
		$this->_init('questions', 'id');
	}
	
}