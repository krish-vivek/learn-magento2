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
        \Magento\Catalog\Model\ProductFactory $productFactory
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->resultRawFactory = $resultRawFactory;
        $this->formKeyValidator = $formKeyValidator;
        $this->_productFactory = $productFactory;
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

         /** @var \Magento\Framework\Controller\Result\Raw $resultRaw */
        $resultRaw = $this->resultRawFactory->create();
        if ($this->getRequest()->getMethod() !== 'POST' || !$this->getRequest()->isXmlHttpRequest()) {
            return $resultRaw->setHttpResponseCode($httpBadRequestCode);
        }

        $formKeyValidation = $this->formKeyValidator->validate($this->getRequest());

        $sku = (string)$this->getRequest()->getPost('code');

        $collection = $this->_productFactory->create()->getCollection();

        $collection->getSelect()->join(
             array('name' => $collection->getTable('catalog_product_entity_varchar')),
             'e.entity_id = name.entity_id',
             array('value')
        );


        /*----Join Query for getting value id from media_gallery_value table----- */

        $collection->getSelect()->join(
             array('value_entity' => $collection->getTable('catalog_product_entity_media_gallery_value')),
             'e.entity_id = value_entity.entity_id',
             array('value_id')
        );

        /*----Join Query for getting value from media_gallery table using value_id----- */

        $collection->getSelect()->join(
            array('value_data' => $collection->getTable('catalog_product_entity_media_gallery')),
            'value_entity.value_id = value_data.value_id',
            array('value_data.value')
        );

        /*----Here, you can get the unique product ids wich have images ----- */

        $collection->getSelect()
            ->reset(\Zend_Db_Select::COLUMNS)
            ->columns(array('entity_id','sku','name.value','value_data.value as image'))     
            ->group(array('entity_id'));

        $collection->addAttributeToFilter([['attribute' => 'sku', 'like' => '%'.$sku.'%']]);

        $response = [
            'errors' => false,
            'data' => $collection->getData()
        ];

        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->resultJsonFactory->create();
        return $resultJson->setData($response);
    }
}
