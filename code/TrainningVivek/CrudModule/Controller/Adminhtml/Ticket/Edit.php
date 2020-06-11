<?php

namespace TrainningVivek\CrudModule\Controller\Adminhtml\Ticket;
use Magento\Backend\App\Action;
use Magento\Framework\Registry;
use Magento\Framework\App\ResposeInterface;
use Magento\Framework\View\Result\PageFactory;
use TrainningVivek\CrudModule\Model\MarsTicket;

class Edit extends Action
{
	protected $marsTicket;
	protected $pageFactory;
	protected $registry;

	public function __construct(
		MarsTicket $marsTicket,
		PageFactory $pageFactory,
		Registry $registry,
		Action\Context $context)
	{
		$this->registry = $registry;
		$this->marsTicket = $marsTicket;
		$this->pageFactory = $pageFactory;
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
    	$id = $this->getRequest()->getparam("id");
    	$model = $this->marsTicket;
    	if ($id) {
    		$model->load($id);
    		if (!$model->getId()) {
    			$this->messageManager->addErrorMessage(__("This ticket does not exist"));
    			$result = $this->resultRedirectFactory->create();
    			return $result->setPath('mars/ticket/index');
    		}
    	}

    	$data = $this->_getSession()->getFormData(true);

    	if (!empty($data)) {
    		$model->setData($data);
    	}

    	$this->registry->register("ticket", $model);

    	/** @var \Magento\Framework\View\Result\Page $resultPage */
    	$resultPage = $this->pageFactory->create();

		$resultPage->addBreadcrumb($id ? __("Edit Ticket"): __("Add a New Ticket"), __("Title"));

		if ($id) {
			$resultPage->getConfig()->getTitle()->prepend('Edit');
		} else {
			$resultPage->getConfig()->getTitle()->prepend('Add');
		}

		return $resultPage;	
    }
}