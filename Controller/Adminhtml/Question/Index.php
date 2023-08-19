<?php

namespace Custom\FAQ\Controller\Adminhtml\Question;

class Index extends \Magento\Backend\App\Action
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
		$resultPage->setActiveMenu('Custom_FAQ::question');
		$resultPage->getConfig()->getTitle()->prepend(__('FAQ'));
		return $resultPage;
	}
	


}