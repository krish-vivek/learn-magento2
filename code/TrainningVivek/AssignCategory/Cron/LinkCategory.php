<?php

namespace TrainningVivek\AssignCategory\Cron;

use \Psr\Log\LoggerInterface;

class LinkCategory
{
	protected $_productCollectionFactory;

    protected $logger;

	public function __construct(\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory, \Magento\Catalog\Api\CategoryLinkManagementInterface $categoryLinkManagement, LoggerInterface $logger, \Magento\Catalog\Model\ProductFactory $productFactory) {
		$this->_productCollectionFactory = $productCollectionFactory;
		$this->categoryLinkManagement = $categoryLinkManagement;
        $this->_productFactory = $productFactory;
        $this->logger = $logger;
	}

	public function execute() {
		$fromDate = date('Y-m-d H:i:s', strtotime('-3 days'));
        $toDate = date('Y-m-d H:i:s', time());
        $collection = $this->_productCollectionFactory->create();
        $collection = $collection->addFieldToFilter('created_at', array('from' => $fromDate, 'to' => $toDate));
        //$collection->setPageSize(); // fetching only 10 products
        if (!empty($collection->getData())) {
            foreach ($collection->getData() as $key => $value) {
                $cats = [];
                $commaSeperated = '';
                $product = $this->_productFactory->create()->load($value['entity_id']);
                $cats = $product->getCategoryIds();
                if (!in_array('41', $cats)) {
                    $mergeCat = array_merge($cats, ['41']);
                } else {
                    $mergeCat = $cats;
                }
                
                if (!empty($mergeCat)) {
                    $commaSeperated = implode(',', $mergeCat);
                }
                $this->categoryLinkManagement->assignProductToCategories(
                    $value['sku'],
                    $mergeCat
                );
                $this->logger->info("Category ".$commaSeperated." is assign to product ".$value['sku']);
            }
        }
	}
}