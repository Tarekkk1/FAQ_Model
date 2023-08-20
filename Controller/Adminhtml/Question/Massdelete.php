<?php

namespace Custom\FAQ\Controller\Adminhtml\Question;

use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Custom\FAQ\Model\ResourceModel\Question\CollectionFactory;
use Custom\FAQ\Model\QuestionFactory;

class Massdelete extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;
	protected $questionFactory = false;

	public $collectionFactory;

    public $filter;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory,
	 	Filter $filter,
        CollectionFactory $collectionFactory,
          QuestionFactory $questionFactory           
	)
	{
		parent::__construct($context);
		$this->questionFactory = $questionFactory;
	 	$this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
		$this->resultPageFactory = $resultPageFactory;
	}
    public function execute()
    {  
        $ids = $this->getRequest()->getParams();
    
        try {
            $count = 0;
    
            if (isset($ids['selected']) && is_array($ids['selected'])) {
    
              
                foreach ($ids['selected'] as $id) {
                    $model = $this->questionFactory->create()->load($id);
                    $model->delete();
                    $count++;
                } 
    
                $this->messageManager->addSuccess(__('A total of %1 faq(s) have been deleted.', $count));
    
            } else {
                $this->messageManager->addError(__('No faq(s) have been selected for deletion.'));
            }
            
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
    
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }
    
    
	

}