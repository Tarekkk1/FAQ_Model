<?php
namespace Custom\FAQ\Model\ResourceModel\Question;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'question_id';
	protected $_eventPrefix = 'custom_faq_question_collection';
	protected $_eventObject = 'question_collection';

	protected function _construct()
	{
		$this->_init('Custom\FAQ\Model\Question', 'Custom\FAQ\Model\ResourceModel\Question');
	}

}