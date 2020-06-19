<?php

namespace TrainningVivek\ExtendCustomer\Block;

use Magento\Framework\App\Config\ScopeConfigInterface;

class AdditionalFields extends \Magento\Framework\View\Element\Template
{
    protected $scopeConfig;

    /**
     * @var \Magento\Customer\Helper\Session\CurrentCustomer
     */
    protected $currentCustomer;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Framework\App\Http\Context $httpContext
     * @param \Magento\Customer\Model\Registration $registration
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->currentCustomer = $currentCustomer;
        parent::__construct($context, $data);
    }

    /**
     * Returns the Magento Customer Model for this block
     *
     * @return \Magento\Customer\Api\Data\CustomerInterface|null
     */
    public function getCustomer()
    {
        try {
            return $this->currentCustomer->getCustomer();
        } catch (NoSuchEntityException $e) {
            return null;
        }
    }

    /**
     * Checking field allowed or not
     *
     * @return bool
     */
    public function fatherIsAllowed()
    {
        $fatherNameAllowed = $this->scopeConfig->getValue('additinal_fields_section_customer/additinal_fields/father_name');
        return $fatherNameAllowed;
    }

    /**
     * Checking field allowed or not
     *
     * @return bool
     */
    public function motherIsAllowed()
    {
        $motherNameAllowed = $this->scopeConfig->getValue('additinal_fields_section_customer/additinal_fields/mother_name');
        return $motherNameAllowed;
    }
}