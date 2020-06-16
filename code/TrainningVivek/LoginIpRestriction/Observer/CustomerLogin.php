<?php

namespace TrainningVivek\LoginIpRestriction\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Magento\Framework\Stdlib\Cookie\PhpCookieManager;
use Magento\Framework\Stdlib\Cookie\CookieMetadataFactory;

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

    /**
     * @param Session $customerSession
     */
    public function __construct(
    	Context $context,
        Session $customerSession,
        RemoteAddress $remoteAddress,
        PhpCookieManager $cookieMetadataManager,
        PhpCookieManager $cookieMetadataFactory
    ) {
    	$this->cookieMetadataFactory = $cookieMetadataFactory;
    	$this->cookieMetadataManager = $cookieMetadataManager;
        $this->session = $customerSession;
        $this->remoteAddress = $remoteAddress;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
    	$allowIp = ['202.131.115.180'];

        $customer = $observer->getEvent()->getCustomer();

        $ip = $this->remoteAddress->getRemoteAddress();
        
        if (!in_array($ip, $allowIp)) {
        	$lastCustomerId = $this->session->getId();
	        $this->session->logout()->setBeforeAuthUrl($this->_redirect->getRefererUrl())
	            ->setLastCustomerId($lastCustomerId);
	        if ($this->getCookieManager()->getCookie('mage-cache-sessid')) {
	            $metadata = $this->getCookieMetadataFactory()->createCookieMetadata();
	            $metadata->setPath('/');
	            $this->getCookieManager()->deleteCookie('mage-cache-sessid', $metadata);
	        }

	        /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
	        $resultRedirect = $this->resultRedirectFactory->create();
	        $resultRedirect->setPath('*/*/logoutSuccess');
	        return $resultRedirect;
        }
    }
}