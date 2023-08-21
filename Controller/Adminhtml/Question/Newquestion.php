<?php

namespace Custom\FAQ\Controller\Adminhtml\Question;

class Newquestion extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;
	protected $questionModel;
	protected $questionResourceModel;


	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
		,
		\Custom\FAQ\Model\Question $questionModel,
		\Custom\FAQ\Model\ResourceModel\Question $questionResourceModel
		
	
		)
	{
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
		$this->questionModel = $questionModel;
		$this->questionResourceModel = $questionResourceModel;
		
	}



	public function execute() {
		try {
			$id = $this->getRequest()->getParam('id');
	
			// Check if the necessary objects are initialized
			if (!$this->questionModel || !$this->resultPageFactory || !$this->questionResourceModel) {
				throw new \Exception('Required objects not initialized.');
			}
	
			$model = $this->questionModel;
			$resultPage = $this->resultPageFactory->create();
	
			if ($id) {
				$this->questionResourceModel->load($model, $id);
	
				if (!$model->getId()) {
					$this->messageManager->addErrorMessage('This category no longer exists.');
					$this->_redirect('*/*/index');
					return; // Early return to ensure that no further code executes in this case.
				}
	
				if (!$resultPage->getConfig() || !$resultPage->getConfig()->getTitle()) {
					throw new \Exception('Unable to get configuration or title.');
				}
				
				$resultPage->getConfig()->getTitle()->prepend(__('Edit Question'));
			} else {
				if (!$resultPage->getConfig() || !$resultPage->getConfig()->getTitle()) {
					throw new \Exception('Unable to get configuration or title.');
				}
	
				$resultPage->getConfig()->getTitle()->prepend(__('Add New Question'));
			}
	
			return $resultPage;
		} catch (\Exception $e) {
			// Here you can log the exception or handle it as per your needs.
			$this->messageManager->addErrorMessage($e->getMessage());
			$this->_redirect('*/*/index'); // Redirect to a safe page.
		}
	}
	
	// public function execute()
	// {
	
	// 	$resultPage = $this->resultPageFactory->create();
	// 	$id=$this->getRequest()->getParam('id');
	// 	if(!empty($id)){
	// 		$resultPage->getConfig()->getTitle()->prepend((__('Edit Question')));
	// 	}else{
	// 		$resultPage->getConfig()->getTitle()->prepend((__('Add New Question')));
	// 	}
	   

	//    return $resultPage;
	// }
	


}