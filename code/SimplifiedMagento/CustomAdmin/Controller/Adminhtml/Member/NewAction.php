<?php

namespace SimplifiedMagento\CustomAdmin\Controller\Adminhtml\Member;

use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Backend\Model\View\Result\ForwardFactory;

class NewAction extends Action
{
	protected $forwardFactory;

	public function __construct(
		ForwardFactory $forwardFactory,
		Action\Context $context)
	{
		$this->forwardFactory = $forwardFactory;
		parent::__construct($context);
	}

	protected function _isAllowed()
	{
		return $this->_authorization->isAllowed("SimplifiedMagento_CustomAdmin::parent");
	}

	/**
	 * Execute action based on request and return result
	 *
	 * @return \Magento\Framework\App\ResponseInterface|ResponseInterface
	 * @throws \Magento\Framework\Exception\NotFoundException
	 */
	public function execute()
	{
		/** @var \Magento\Backend\Model\View\Result\ForwardFactory $resultForward  */
		$resultForward = $this->forwardFactory->create();

		return $resultForward->forward('edit');
	}
}