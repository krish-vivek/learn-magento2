<?php

namespace TrainningVivek\LoginIpRestriction\Model\ResourceModel\LoggingLog;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use TrainningVivek\LoginIpRestriction\Model\LoggingLog;
use TrainningVivek\LoginIpRestriction\Model\ResourceModel\LoggingLog as LoggingLogResource;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';
    
	/**
     * Initialization here
     *
     * @return void
     */
    protected function _construct()
    {
    	parent::_construct();
    	$this->_init(LoggingLog::class, LoggingLogResource::class);
    }
}