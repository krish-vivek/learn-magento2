<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace TrainningVivek\ProductDailyDeal\Model\Product\Attribute\Backend;

/**
 * Catalog product DealTime backend attribute model.
 */
class DealTime extends \Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend
{
    /**
     * @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */
    protected $_localeDate;

    /**
     * @param \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate
     * @codeCoverageIgnore
     */
    public function __construct(\Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate)
    {
        $this->_localeDate = $localeDate;
    }

    /**
     * @param \Magento\Framework\DataObject $object
     *
     * @return $this
     */
    public function beforeSave($object)
    {
        $this->validate($object);
        return parent::beforeSave($object);
    }

    /**
     * Validate DealTime
     *
     * @param Product $object
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function validate($object)
    {
        $attrCode = $this->getAttribute()->getAttributeCode();
        $value = $object->getData('deal_status');
        $dealDateValue = $object->getData('deal_time');
        if ($value == 1) {
            if ($this->formatDate($object->getData('deal_time')) === null) {
                throw new \Magento\Framework\Exception\LocalizedException(__('Deal Date is Reqired.'));
            }
        }

        return true;
    }

    /**
     * Prepare date for save in DB
     *
     * string format used from input fields (all date input fields need apply locale settings)
     * int value can be declared in code (this meen whot we use valid date)
     *
     * @param string|int|\DateTimeInterface $date
     * @return string
     */
    public function formatDate($date)
    {
        if (empty($date)) {
            return null;
        }
        // unix timestamp given - simply instantiate date object
        if (is_scalar($date) && preg_match('/^[0-9]+$/', $date)) {
            $date = (new \DateTime())->setTimestamp($date);
        } elseif (!($date instanceof \DateTimeInterface)) {
            // normalized format expecting Y-m-d[ H:i:s]  - time is optional
            $date = new \DateTime($date);
        }
        return $date->format('Y-m-d H:i:s');
    }
}
