<?php

namespace SimplifiedMagento\CustomAdmin\Controller\Adminhtml\Member;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\View\Result\PageFactory;
use SimplifiedMagento\Database\Model\AffiliateMember;

class Delete extends Action
{
	protected  $model;
	protected $pageFactory;
	protected $affiliateMember;
	protected $resultRedirectFactory;

	public function __construct(
		RedirectFactory $redirectFactory,
		AffiliateMember $affiliateMember,
		PageFactory $pageFactory,
		Action\Context $context)
	{
		$this->resultRedirectFactory = $redirectFactory;
		$this->model = $affiliateMember;
		$this->pageFactory = $pageFactory;
		parent::__construct($context);
	}

	protected function _isAllowed()
	{
		return $this->_authorization->isAllowed("SimplifiedMagento_CustomAdmin::parent");
	}

	public function execute()
	{
		$resultRedirect = $this->resultRedirectFactory->create();
		$id = $this->getRequest()->getParam('id');
		if ($id) {
			$model = $this->model;
			$model->load($id);
			try {
				$model->delete();
				$this->messageManager->addSuccessMessage(__('Member Deleted'));
				return $resultRedirect->setPath('*/*/index');
			} catch(\Exception $e) {
				$this->messageManager->addErrorMessage(__($e->getMessage()));
				return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
			}
		}
	}
}