<?php

namespace Custom\FAQ\Model;

use Magento\Framework\Model\AbstractModel;

class Category extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Custom\FAQ\Model\ResourceModel\Category');
    }

}