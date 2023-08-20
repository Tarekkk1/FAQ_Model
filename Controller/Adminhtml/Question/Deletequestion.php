<?php

namespace Custom\FAQ\Controller\Adminhtml\Question;

class Deletequestion extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;
	protected $questionFactory = false;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory,
		\Custom\FAQ\Model\QuestionFactory $questionFactory
	)
	{
		$this->questionFactory = $questionFactory;
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}

	public function execute()
	{

        $resultRedirect = $this->resultRedirectFactory->create();
        $id=$this->getRequest()->getParam('id');

       
	     try{
	           	   $model = $this->questionFactory->create()->load($id);
				   $model->delete();
		    	$this->messageManager->addSuccessMessage(__('You have deleted the question.'));
			}catch(\Exception $e){
				 $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the question.'));
			}
	 return $resultRedirect->setPath('*/*/');
	}


}