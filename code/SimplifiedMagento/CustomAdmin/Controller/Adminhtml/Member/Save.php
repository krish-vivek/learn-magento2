<?php

namespace SimplifiedMagento\CustomAdmin\Controller\Adminhtml\Member;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\View\Result\PageFactory;
use SimplifiedMagento\Database\Model\AffiliateMember;

class Save extends Action
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
		$data = $this->getRequest()->getPostValue();

		/** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect  */
		$resultRedirect = $this->resultRedirectFactory->create();

		if ($data) {
			$member = $this->getRequest()->getParam('member');
			if (array_key_exists('entity_id', $member)) {
				$id = $member['entity_id'];
				$model = $this->model->load($id);
			}

			$model = $this->model->setData($data['member']);
		}

		try {
			$model->save();
			$this->messageManager->addSuccessMessage(__('Affiliate Member saved Successfully'));
			$this->_getSession()->setFormData(false);
			if ($this->getRequest()->getparam('back')) {
				return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
			}
			return $resultRedirect->setPath('*/*/index');

		} catch (\Magento\Framework\Exception\LocalizedException $e) {
			$this->messageManager->addErrorMessage($e->getMessage());
		}

		return $resultForward->forward('edit');

	}
}