<?php

namespace TrainningVivek\CrudModule\Model\ResourceModel\MarsTicket;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use SimplifiedMagento\Database\Model\MarsTicket;
use SimplifiedMagento\Database\Model\ResourceModel\MarsTicket as MarsTicketResource;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'ticket_id';
    
	/**
     * Initialization here
     *
     * @return void
     */
    protected function _construct()
    {
    	parent::_construct();
    	$this->_init(AffiliateMember::class, MarsTicketResource::class);
    }
}