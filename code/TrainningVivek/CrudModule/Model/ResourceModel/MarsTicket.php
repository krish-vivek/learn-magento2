<?php

namespace TrainningVivek\CrudModule\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class MarsTicket extends AbstractDb
{
	/**
     * Resource initialization
     *
     * @return void
     */
	protected function _construct()
	{
		$this->_init('mars_ticket', 'ticket_id');
	}
}