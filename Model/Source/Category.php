<?php

namespace Custom\FAQ\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Custom\FAQ\Model\CategoryFactory;

class Category implements OptionSourceInterface
{
    protected $categoryFactory;

    public function __construct(CategoryFactory $categoryFactory)
    {
        $this->categoryFactory = $categoryFactory;
    }

    public function toOptionArray()
    { 
        $categories = $this->categoryFactory->create()->getCollection()->addFieldToSelect(['id', 'title']);
        $options = [];
        foreach ($categories as $category) {
            $options[] = [
                'label' => $category->getTitle(),
                'value' => $category->getId()
            ];
        }
        return $options;
    }
}