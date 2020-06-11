<?php

namespace TrainningVivek\CrudModule\Controller\Adminhtml\Ticket;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\View\Result\PageFactory;
use TrainningVivek\CrudModule\Model\MarsTicket;

class Delete extends Action
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
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            $model = $this->model;
            $model->load($id);
            try {
                $model->delete();
                $this->messageManager->addSuccessMessage(__('Ticket Deleted'));
                return $resultRedirect->setPath('*/*/index');
            } catch(\Exception $e) {
                $this->messageManager->addErrorMessage(__($e->getMessage()));
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
    }
}