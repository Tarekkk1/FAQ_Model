<?php

namespace Custom\FAQ\Controller\Adminhtml\Question;

class Newquestion extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	)
	{
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}

	public function execute()
	{
	
		$resultPage = $this->resultPageFactory->create();
		$id=$this->getRequest()->getParam('id');
		if(!empty($id)){
			$resultPage->getConfig()->getTitle()->prepend((__('Edit Question')));
		}else{
			$resultPage->getConfig()->getTitle()->prepend((__('Add New Question')));
		}
	   

	   return $resultPage;
	}
	


}