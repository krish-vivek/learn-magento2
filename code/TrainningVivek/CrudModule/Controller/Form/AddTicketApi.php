<?php

namespace TrainningVivek\CrudModule\Controller\Form;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use TrainningVivek\CrudModule\Model\MarsTicket;

class AddTicketApi extends Action
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
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->pageFactory->create();
        return $resultPage;
    }
}