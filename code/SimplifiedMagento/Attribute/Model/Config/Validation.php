<?php

namespace SimplifiedMagento\Attribute\Model\Config;

use Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend;

class Validation extends AbstractBackend
{
	/**
     * Retrieve All options
     *
     * @return array
     */
    public function validate($object)
    {
        if ($object->getData($this->getAttribute()->getAttributeCode()) < 10)
            throw new LocalizeException(__('value must not be less than 10'));
    	return parent::validate($object);
    }
}