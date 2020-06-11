<?php

namespace TrainningVivek\CrudModule\Controller\Adminhtml\Ticket;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\View\Result\PageFactory;
use TrainningVivek\CrudModule\Model\MarsTicket;

class Save extends Action
{
	protected  $model;
	protected $pageFactory;
	protected $marsTicket;
	protected $resultRedirectFactory;

	public function __construct(
		RedirectFactory $redirectFactory,
		MarsTicket $marsTicket,
		PageFactory $pageFactory,
		Action\Context $context)
	{
		$this->resultRedirectFactory = $redirectFactory;
		$this->model = $marsTicket;
		$this->pageFactory = $pageFactory;
		parent::__construct($context);
	}

	protected function _isAllowed()
	{
		return $this->_authorization->isAllowed("TrainningVivek_CrudModule::parent");
	}

	public function execute()
	{
		$data = $this->getRequest()->getPostValue();

		/** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect  */
		$resultRedirect = $this->resultRedirectFactory->create();

		if ($data) {
			$ticket = $this->getRequest()->getParam('ticket');
			if (array_key_exists('ticket_id', $ticket)) {
				$id = $ticket['ticket_id'];
				$model = $this->model->load($id);
			}
			if (array_key_exists('ticket_tags', $ticket)) {
				$data['ticket']['ticket_tags']=implode(',',$ticket['ticket_tags']);
			}

			$model = $this->model->setData($data['ticket']);
		}

		try {
			$model->save();
			$this->messageManager->addSuccessMessage(__('Mars Ticket saved Successfully'));
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