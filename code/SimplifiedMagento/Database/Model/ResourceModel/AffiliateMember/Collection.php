<?php

namespace SimplifiedMagento\Database\Model\ResourceModel\AffiliateMember;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use SimplifiedMagento\Database\Model\AffiliateMember;
use SimplifiedMagento\Database\Model\ResourceModel\AffiliateMember as AffiliateMemberResource;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    
	/**
     * Initialization here
     *
     * @return void
     */
    protected function _construct()
    {
    	parent::_construct();
    	$this->_init(AffiliateMember::class, AffiliateMemberResource::class);
    }
}