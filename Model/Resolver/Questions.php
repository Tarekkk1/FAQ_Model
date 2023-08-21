<?php

namespace Custom\FAQ\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Custom\FAQ\Model\ResourceModel\Question\CollectionFactory as QuestionCollectionFactory;
use Custom\FAQ\Model\CategoryFactory;   



class Questions implements ResolverInterface
{
    protected $questionCollectionFactory;
    protected $categoryFactory;

    public function __construct(
        QuestionCollectionFactory $questionCollectionFactory,
        CategoryFactory $categoryFactory
    ) {
        $this->questionCollectionFactory = $questionCollectionFactory;
        $this->categoryFactory = $categoryFactory;
    }

    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $questions = [];

        $collection = $this->questionCollectionFactory->create();
        if (isset($args['category_id'])) {
            $collection->addFieldToFilter('category_id', $args['category_id']); 
        }
       
        //print collection
     
        // print_r($collection->getData());
        // exit;
        

        foreach ($collection as $questionData) {
            $questions[] = [
                'id' => $questionData['id'],
                'title' => $questionData['title'],
                'answer' => $questionData['answer'],
                'category' => $this->getCategoryById($questionData['category_id']),
            ];
        }
     

        return $questions;
        
    }

    protected function getCategoryById($categoryId)
{
    $category = $this->categoryFactory->create()->load($categoryId);
    if (!$category->getId()) {
        // handle error or return null, depending on your needs
        return null;
    }
    return [
        'id' => $category->getId(),
        'title' => $category->getTitle(),
    ];
}

}