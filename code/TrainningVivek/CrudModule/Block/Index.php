<?php

namespace TrainningVivek\CrudModule\Block;

use Magento\Framework\View\Element\Template;
use TrainningVivek\CrudModule\Model\ResourceModel\MarsTicket\CollectionFactory;

class Index extends Template
{
    protected $collectionFactory;

    public function __construct(
        Template\Context $context, array $data=[], CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * Retrieve Add Ticket URL
     *
     * @return string
     */
    public function getAddTicketUrl()
    {
        return $this->getUrl('marsfrticket/form/addticket');
    }

    /**
     * Generate and return "Edit Ticket" URL.
     *
     *
     * @param int $ticketId
     * @return string
     */
    public function getTicketEditUrl($ticketId)
    {
        return $this->getUrl('marsfrticket/form/editticket', ['_secure' => true, 'id' => $ticketId]);
    }

    /**
     * Retrieve Add Ticket Data
     *
     * @return string
     */
    public function getTicketData()
    {
        $array = [];
        $collection = $this->collectionFactory->create();
        foreach($collection as $item){
            $array[] = $item->getData();
        }
        return $array;
    }

    /**
     * Returns country html select
     *
     * @return string
     */
    public function getStatus($status = 0)
    {
        if ($status == 0) {
            return 'No';
        } else {
            return 'Yes';
        }
    }

    /**
     * Returns country html select
     *
     * @return string
     */
    public function getTicketType($type = null)
    {
        if ($type == 1) {
            return 'Type 1';
        } elseif ($type == 2) {
            return 'Type 2';
        } elseif ($type == 3) {
            return 'Type 3';
        } 
    }
}