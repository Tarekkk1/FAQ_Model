<?php
namespace Custom\FAQ\Model;
class Question extends \Magento\Framework\Model\AbstractModel
{
	protected function _construct()
	{
		$this->_init('Custom\FAQ\Model\ResourceModel\Question');
	}
}