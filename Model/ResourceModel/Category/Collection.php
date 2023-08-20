<?php

namespace Custom\FAQ\Model\ResourceModel\Category;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'custom_faq_category_collection';

    protected function _construct()
    {
        $this->_init('Custom\FAQ\Model\Category', 'Custom\FAQ\Model\ResourceModel\Category');
    }
}