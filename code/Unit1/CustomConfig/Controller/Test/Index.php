<?php

namespace Unit1\CustomConfig\Controller\Test;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class Index
 * @package Unit1\CustomConfig\Controller\Test\Index
 */
class Index extends Action
{

    /**
     * @var Unit1\CustomConfig\Model\Config
     */
    private $customConfig;

    /**
     * Index constructor.
     * @param Context $context
     */
    public function __construct(
        Context $context,
        \Unit1\CustomConfig\Model\Config $customConfig
    )
    {
        $this->customConfig = $customConfig;
        return parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $storeId = 2;
        $storeWelcomeMsg = $this->customConfig->get('messages/' . $storeId . '/message');
        
        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $result->setContents($storeWelcomeMsg);

        return $result;
    }
}
