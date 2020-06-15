<?php

namespace TrainningVivek\CrudModule\Controller\Page;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use TrainningVivek\CrudModule\Model\ResourceModel\MarsTicket\CollectionFactory;

class Index extends Action
{
    protected $pageFactory;

    public function __construct(PageFactory $pageFactory,Context $context)
    {
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        return $this->pageFactory->create();
    }
}