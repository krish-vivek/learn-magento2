<?php

namespace TrainningVivek\CrudModule\Controller\Form;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use TrainningVivek\CrudModule\Model\MarsTicket;

class EditTicket extends Action
{
    protected $model;
    protected $marsTicket;

    /**
     * @var \Magento\Framework\Controller\Result\ForwardFactory
     */
    protected $resultForwardFactory;

    public function __construct(
        Context $context,
        MarsTicket $marsTicket,
        \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory
    )
    {
        $this->model = $marsTicket;
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Forward $resultForward */
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('addticket');
    }
}