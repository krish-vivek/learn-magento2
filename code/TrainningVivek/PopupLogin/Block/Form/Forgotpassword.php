<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace TrainningVivek\PopupLogin\Block\Form;

use Magento\Customer\Model\Url;
use Magento\Framework\View\Element\Template;

/**
 * Customer account navigation sidebar
 *
 * @api
 * @since 100.0.2
 */
class Forgotpassword extends \Magento\Framework\View\Element\Template
{
    /**
     * @var Url
     */
    protected $customerUrl;

    /**
     * @param Template\Context $context
     * @param Url $customerUrl
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Url $customerUrl,
        array $data = []
    ) {
        $this->customerUrl = $customerUrl;
        parent::__construct($context, $data);
    }

    /**
     * Get login URL
     *
     * @return string
     */
    public function getLoginUrl()
    {
        return $this->customerUrl->getLoginUrl();
    }

    /**
     * Retrieve the form posting URL
     *
     * @return string
     */
    public function getPostActionUrl()
    {
        return $this->getUrl('training/customer_ajax/forgotpassword');
    }
}
