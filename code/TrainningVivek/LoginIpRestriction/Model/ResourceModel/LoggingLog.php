<?php

namespace TrainningVivek\LoginIpRestriction\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class LoggingLog extends AbstractDb
{
	/**
     * Resource initialization
     *
     * @return void
     */
	protected function _construct()
	{
		$this->_init('logging_log', 'id');
	}
}