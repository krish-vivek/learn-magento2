<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace TrainningVivek\PopupLogin\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Captcha\Observer\CaptchaStringResolver;

/**
 * Class CheckRegisterObserver
 *
 * @SuppressWarnings(PHPMD.CookieAndSessionMisuse)
 */
class CheckRegisterObserver implements ObserverInterface
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var \Magento\Captcha\Helper\Data
     */
    protected $_helper;

    /**
     * @var \Magento\Framework\App\ActionFlag
     */
    protected $_actionFlag;

    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $messageManager;

    /**
     * @var \Magento\Framework\Session\SessionManagerInterface
     */
    protected $_session;

    /**
     *
     * @var \Magento\Framework\UrlInterface
     */
    protected $_urlManager;

    /**
     * @var \Magento\Captcha\Observer\CaptchaStringResolver
     */
    protected $captchaStringResolver;

    /**
     * @var \Magento\Framework\App\Response\RedirectInterface
     */
    protected $redirect;

    /**
     * @param \Magento\Captcha\Helper\Data $helper
     * @param \Magento\Framework\App\ActionFlag $actionFlag
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     * @param \Magento\Framework\Session\SessionManagerInterface $session
     * @param \Magento\Framework\UrlInterface $urlManager
     * @param \Magento\Framework\App\Response\RedirectInterface $redirect
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     * @param \Magento\Captcha\Observer\CaptchaStringResolver $captchaStringResolver
     */
    public function __construct(
        \Magento\Captcha\Helper\Data $helper,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Framework\App\ActionFlag $actionFlag,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\Session\SessionManagerInterface $session,
        \Magento\Framework\UrlInterface $urlManager,
        \Magento\Framework\App\Response\RedirectInterface $redirect,
        \Magento\Captcha\Observer\CaptchaStringResolver $captchaStringResolver
    ) {
        $this->_helper = $helper;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->_actionFlag = $actionFlag;
        $this->messageManager = $messageManager;
        $this->_session = $session;
        $this->_urlManager = $urlManager;
        $this->redirect = $redirect;
        $this->captchaStringResolver = $captchaStringResolver;
    }

    /**
     * Check Captcha On User Login Page
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $formId = 'user_create';
        $captchaModel = $this->_helper->getCaptcha($formId);

        $response = [
            'errors' => false,
            'message' => __('Success')
        ];

        if ($captchaModel->isRequired()) {
            /** @var \Magento\Framework\App\Action\Action $controller */
            $controller = $observer->getControllerAction();
            if (!$captchaModel->isCorrect($this->captchaStringResolver->resolve($controller->getRequest(), $formId))) {
                $this->messageManager->addErrorMessage(__('Incorrect CAPTCHA'));
                $this->_actionFlag->set('', \Magento\Framework\App\Action\Action::FLAG_NO_DISPATCH, true);
                $this->_session->setCustomerFormData($controller->getRequest()->getPostValue());
                $url = $this->_urlManager->getUrl('*/*/create', ['_nosecret' => true]);
                $controller->getResponse()->setRedirect($this->redirect->error($url));
            }
        }

        return $this;
    }
}
