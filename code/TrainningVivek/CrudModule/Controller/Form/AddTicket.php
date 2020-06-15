<?php

namespace TrainningVivek\CrudModule\Controller\Form;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use TrainningVivek\CrudModule\Model\MarsTicket;

class AddTicket extends Action
{
    protected $pageFactory;
    protected $model;
    protected $marsTicket;

    public function __construct(
        PageFactory $pageFactory,
        Context $context,
        MarsTicket $marsTicket
    )
    {
        $this->model = $marsTicket;
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getparam("id");

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPostValue();
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
                if (!isset($data['ticket']['ticket_lang'])) {
                    $data['ticket']['ticket_lang']= 0;
                }

                $model = $this->model->setData($data['ticket']);
            }

            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('Mars Ticket saved Successfully'));
                return $resultRedirect->setPath('marsfrticket/page/index');

            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }

            return $resultRedirect->setPath('marsfrticket/page/index');
        }

        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->pageFactory->create();

        if ($id) {
            $resultPage->getConfig()->getTitle()->prepend('Edit');
        } else {
            $resultPage->getConfig()->getTitle()->prepend('Add');
        }

        return $resultPage;
    }
}