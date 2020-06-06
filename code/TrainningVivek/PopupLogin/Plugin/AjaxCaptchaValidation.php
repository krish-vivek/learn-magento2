<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace TrainningVivek\PopupLogin\Plugin;

use Magento\Captcha\Helper\Data as CaptchaHelper;
use Magento\Framework\Session\SessionManagerInterface;
use Magento\Framework\Controller\Result\JsonFactory;

class AjaxCaptchaValidation
{
    /**
     * @var \Magento\Captcha\Helper\Data
     */
    protected $helper;

    /**
     * @var \Magento\Framework\Session\SessionManagerInterface
     */
    protected $sessionManager;

    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;


    protected $captchaStringResolver;

    /**
     * @param CaptchaHelper $helper
     * @param SessionManagerInterface $sessionManager
     * @param JsonFactory $resultJsonFactory
     * @throws \RuntimeException
     */
    public function __construct(
        CaptchaHelper $helper,
        SessionManagerInterface $sessionManager,
        JsonFactory $resultJsonFactory,
         \Magento\Captcha\Observer\CaptchaStringResolver $captchaStringResolver //
    ) {
        $this->helper = $helper;
        $this->sessionManager = $sessionManager;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->captchaStringResolver = $captchaStringResolver;
    }

    /**
     * @param \TrainningVivek\PopupLogin\Controller\Customer\Ajax\Register $subject
     * @param \Closure $proceed
     * @return $this
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    public function aroundExecute(
        \TrainningVivek\PopupLogin\Controller\Customer\Ajax\Register $subject,
        \Closure $proceed
    ) {
        $formId = 'user_create'; 
        $captchaModel = $this->helper->getCaptcha($formId);
        $result = $this->resultJsonFactory->create();

        if (!$captchaModel->isCorrect($this->captchaStringResolver->resolve($subject->getRequest(), $formId))) {
            $this->sessionManager->setCustomerFormData($subject->getRequest()->getPostValue());
            $response = [
                'errors' => true,
                'message' => __('Incorrect CAPTCHA. Reload captcha before proceed')
            ];
            return $result->setData($response);
        }        
        return $proceed();
    }
}