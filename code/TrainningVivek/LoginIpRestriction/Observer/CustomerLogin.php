<?php

namespace TrainningVivek\LoginIpRestriction\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Magento\Framework\Stdlib\Cookie\PhpCookieManager;
use Magento\Framework\Stdlib\Cookie\CookieMetadataFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use TrainningVivek\LoginIpRestriction\Model\LoggingLog;

class CustomerLogin implements ObserverInterface
{
	/**
     * @var Session
     */
    protected $session;

    private $remoteAddress;

    /**
     * @var CookieMetadataFactory
     */
    private $cookieMetadataFactory;

    /**
     * @var PhpCookieManager
     */
    private $cookieMetadataManager;

    protected $scopeConfig;

    protected $resultRedirectFactory;

    protected $loggingLog;

    /**
     * @param Session $customerSession
     */
    public function __construct(
    	Context $context,
        Session $customerSession,
        RemoteAddress $remoteAddress,
        PhpCookieManager $cookieMetadataManager,
        CookieMetadataFactory $cookieMetadataFactory,
        ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory,
        LoggingLog $loggingLog
    ) {
    	$this->cookieMetadataFactory = $cookieMetadataFactory;
    	$this->cookieMetadataManager = $cookieMetadataManager;
        $this->session = $customerSession;
        $this->remoteAddress = $remoteAddress;
        $this->scopeConfig = $scopeConfig;
        $this->messageManager = $messageManager;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->loggingLog = $loggingLog;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $restrictIpAdd = [];
        $restrictIp = $this->scopeConfig->getValue('ip_section_customer/ip_customer/ip_address');
        if (!empty($restrictIp)) {
            $restrictIpAdd = explode(',', $restrictIp);
        }

        $customer = $observer->getEvent()->getCustomer();
        $ip = $customer->getIpAddress();

        $this->loggingLog->setEmail($customer->getEmail());
        $this->loggingLog->setIp($ip);
        $this->loggingLog->setEntityId($customer->getId());
        try{
            $this->loggingLog->save();
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $messages = $e->getMessage();
        }
        
        if (in_array($ip, $restrictIpAdd)) {
            $lastCustomerId = $this->session->getId();
            $this->session->logout()->setLastCustomerId($lastCustomerId);
            if ($this->cookieMetadataManager->getCookie('mage-cache-sessid')) {
                $metadata = $this->cookieMetadataFactory->createCookieMetadata();
                $metadata->setPath('/');
                $this->cookieMetadataManager->deleteCookie('mage-cache-sessid', $metadata);
            }

            // HERE IS MY CODE
            $message = "your ip address is blocked";
            $this->messageManager->addError($message);

            /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('*/*/logoutSuccess');
            return $resultRedirect;
        }
    }
}