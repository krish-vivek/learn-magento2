<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace TrainningVivek\WholesaleFastOrder\Controller\Product\Ajax;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Escaper;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\SecurityViolationException;


class Items extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var \Magento\Framework\Controller\Result\RawFactory
     */
    protected $resultRawFactory;

    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    protected $_productFactory;

    /**
     * @param Context $context
     * @param Session $customerSession
     * @param AccountManagementInterface $customerAccountManagement
     * @param Escaper $escaper
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     * @param \Magento\Framework\Controller\Result\RawFactory $resultRawFactory
     * @param \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator
     */
    public function __construct(
        Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->resultRawFactory = $resultRawFactory;
        $this->formKeyValidator = $formKeyValidator;
        $this->_productFactory = $productFactory;
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }

    /**
     * Forgot customer password action
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $httpBadRequestCode = 400;

        $baseUrl = $this->_storeManager->getStore()->getBaseUrl();
        $baseUrl = str_replace('/'.$this->_storeManager->getDefaultStoreView()->getCode().'/','/', $baseUrl);

         /** @var \Magento\Framework\Controller\Result\Raw $resultRaw */
        $resultRaw = $this->resultRawFactory->create();
        if ($this->getRequest()->getMethod() !== 'POST' || !$this->getRequest()->isXmlHttpRequest()) {
            return $resultRaw->setHttpResponseCode($httpBadRequestCode);
        }

        $formKeyValidation = $this->formKeyValidator->validate($this->getRequest());

        $sku = (string)$this->getRequest()->getPost('code');

        $collection = $this->_productFactory->create()->getCollection();
        $collection->addFieldToSelect('*');
        $collection->addAttributeToSelect('*');

        $collection->joinField('qty',
             'cataloginventory_stock_item',
             'qty',
             'product_id=entity_id',
             '{{table}}.stock_id=1',
             'left'
         );
        
        $collection->addAttributeToFilter([['attribute' => 'sku', 'like' => '%'.$sku.'%']]);

        $productArray = [];
        $i = 0;
        foreach ($collection as $key => $row) {
            $productArray[$i]['id'] = $row['entity_id'];
            $productArray[$i]['sku'] = $row['sku'];
            $productArray[$i]['name'] = $row['name'];
            $productArray[$i]['image'] = $baseUrl.'pub/media/catalog/product'.$row['image'];
            $productArray[$i]['price'] = $row['price'];
            $productArray[$i]['qty'] = $row['qty'];
            $i++;
        }


        $response = [
            'errors' => false,
            'data' => $productArray
        ];

        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->resultJsonFactory->create();
        return $resultJson->setData($response);
    }
}
