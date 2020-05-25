<?php

namespace SimplifiedMagento\CustomAdmin\Controller\Adminhtml\Member;

use Magento\Backend\App\Action;
use Magento\Ui\Component\MassAction\Filter;
use SimplifiedMagento\Database\Model\ResourceModel\AffiliateMember\CollectionFactory;
use Magento\Backend\Model\View\Result\RedirectFactory;

class MassDelete extends Action
{
	protected $filter;
	protected $collectionFactory;
	protected $resultRedirectFactory;

	public function __construct(
		Filter $filter,
		RedirectFactory $redirectFactory,
		CollectionFactory $collectionFactory,
		Action\Context $context)
	{
		$this->filter = $filter;
		$this->collectionFactory = $collectionFactory;
		$this->resultRedirectFactory = $redirectFactory;
		parent::__construct($context);
	}

	/**
	 * Execute action based on request and return result
	 *
	 * @return \Magento\Framework\App\ResponseInterface|ResponseInterface
	 * @throws \Magento\Framework\Exception\NotFoundException
	 */
	public function execute()
	{
		$collection = $this->filter->getCollection($this->collectionFactory->create());
		foreach ($collection as $key => $item) {
			$item->delete();
		}
		$size = $collection->getSize();
		$this->messageManager->addSuccessMessage(__('A total of '.$size.' have been deleted'));
		$resultRedirect = $this->resultRedirectFactory->create();
		return $resultRedirect->setPath('*/*/index');
	}
}