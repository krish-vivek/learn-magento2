<?php

namespace TrainningVivek\CrudModule\Controller\Adminhtml\Ticket;
use Magento\Backend\App\Action;
use Magento\Framework\App\ResposeInterface;
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
		return $this->_authorization->isAllowed("TrainningVivek_CrudModule::parent");
	}

	/**
     * Execute action based on request and return result
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResposeInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
    	/** @var \Magento\Backend\View\ResultForward $resultForward */
    	$resultForward = $this->forwardFactory->create();
    	return $resultForward->forward('edit');
    }
}