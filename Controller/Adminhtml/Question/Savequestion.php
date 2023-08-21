<?php

namespace Custom\FAQ\Controller\Adminhtml\Question;

class Savequestion extends \Magento\Backend\App\Action
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
		parent::__construct($context  );
		$this->resultPageFactory = $resultPageFactory;
	}

    public function execute()
	{
		$data = $this->getRequest()->getPostValue();
      /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $id=$this->getRequest()->getParam('id');
        //echo $id; exit;
	     try{
	        /** @var \Magento\Cms\Model\Page $model */
	           if(isset($id) && !empty($id)){
	           	   $model = $this->questionFactory->create()->load($id);
				   $model->addData($data);
				   $model->save();
	           }else{
		           $model = $this->questionFactory->create();
			
            $model->setTitle( $data['title']);
            $model->setAnswer( $data['answer']);
        
            $model->setCategoryId( $data['category_id']);
				   $model->save();
			   }
		    	$this->messageManager->addSuccessMessage(__('You saved the question.'));
			}catch(\Exception $e){
				 $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the question.'));
			}
	 return $resultRedirect->setPath('*/*/');
	}

}