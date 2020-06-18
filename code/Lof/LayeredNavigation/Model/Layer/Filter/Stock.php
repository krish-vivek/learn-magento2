<?php

namespace Lof\LayeredNavigation\Model\Layer\Filter;

class Stock extends \Magento\Catalog\Model\Layer\Filter\AbstractFilter
{
    const IN_STOCK_COLLECTION_FLAG = 'lof_stock_filter_applied';
    const CONFIG_FILTER_LABEL_PATH = 'In stock';
    const CONFIG_URL_PARAM_PATH    = 'in-stock';
    protected $_activeFilter = false;
    protected $_requestVar = 'in-stock';

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;
    /**
     * @var \Magento\CatalogInventory\Model\ResourceModel\Stock\Status
     */
    protected $_stockResource;

    /**
     * Stock constructor.
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Catalog\Model\Layer\Filter\ItemFactory $filterItemFactory
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Catalog\Model\Layer $layer
     * @param \Magento\CatalogInventory\Model\ResourceModel\Stock\Status $stockResource
     * @param \Magento\Catalog\Model\Layer\Filter\Item\DataBuilder $itemDataBuilder
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Catalog\Model\Layer\Filter\ItemFactory $filterItemFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Model\Layer $layer,
        \Magento\CatalogInventory\Model\ResourceModel\Stock\Status $stockResource,
        \Magento\Catalog\Model\Layer\Filter\Item\DataBuilder $itemDataBuilder,
        array $data = []
    ) {
        $this->_stockResource = $stockResource;
        $this->_scopeConfig = $scopeConfig;
        parent::__construct($filterItemFactory, $storeManager, $layer, $itemDataBuilder, $data);
        $this->_requestVar = self::CONFIG_URL_PARAM_PATH;
    }

    /**
     * @param \Magento\Framework\App\RequestInterface $request
     * @return $this
     */
    public function apply(\Magento\Framework\App\RequestInterface $request)
    {
        $filter = $request->getParam($this->getRequestVar(), null);
        if (is_null($filter)) {
            return $this;
        }
        $attributeValue = explode(',', $filter);
        $this->_activeFilter = true;

        if(strpos($filter, ',') == false){
            $collection = $this->getLayer()->getProductCollection();
            $collection->getSelect()->where('stock_status_idx.stock_status = ?', $filter);
        }

        $state = $this->getLayer()->getState();
        foreach($attributeValue as $value){

            $state->addFilter(
                $this->_createItem($this->getLabel($value), $value)
            );
        }
        return $this;
    }
    /**
     * Get filter name
     *
     * @return string
     */
    public function getName()
    {
        return self::CONFIG_FILTER_LABEL_PATH;
    }
    /**
     * Get data array for building status filter items
     *
     * @return array
     */
    protected function _getItemsData()
    {

        $data = [];
        foreach ($this->getStatuses() as $status) {

            $data[] = [
                'label' => $this->getLabel($status),
                'value' => $status,
                'count' => $this->getProductsCount($status)
            ];

        }
        return $data;
    }
    /**
     * get available statuses
     * @return array
     */
    public function getStatuses()
    {
        return [
            \Magento\CatalogInventory\Model\Stock::STOCK_IN_STOCK,
            \Magento\CatalogInventory\Model\Stock::STOCK_OUT_OF_STOCK
        ];
    }
    /**
     * @return array
     */
    public function getLabels()
    {
        return [
            \Magento\CatalogInventory\Model\Stock::STOCK_IN_STOCK => __('In Stock'),
            \Magento\CatalogInventory\Model\Stock::STOCK_OUT_OF_STOCK => __('Out of stock'),
        ];
    }
    /**
     * @param $value
     * @return string
     */
    public function getLabel($value)
    {
        $labels = $this->getLabels();
        if (isset($labels[$value])) {
            return $labels[$value];
        }
        return '';
    }



    /**
     * @param $value
     * @return string
     */

    public function getProductsCount($value)
    {

        $collection = $this->getLayer()->getProductCollection();
        $select = clone $collection->getSelect();
//        $from = $select->getPart(\Zend_Db_Select::FROM);
//        if (!isset($from['stock_status_idx'])) {
//
//            $select->joinLeft(
//                [
//                    'stock_status_idx' => $this->_stockResource->getMainTable()
//                ],
//                'e.entity_id = stock_status_idx.product_id AND stock_status_idx.stock_id = ?',
//                \Magento\CatalogInventory\Model\Stock::DEFAULT_STOCK_ID,
//                ['stock_status_idx.*']
//            );
//        }
//        // reset columns, order and limitation conditions
        $select->reset(\Zend_Db_Select::COLUMNS);
        $select->reset(\Zend_Db_Select::ORDER);
        $select->reset(\Zend_Db_Select::LIMIT_COUNT);
        $select->reset(\Zend_Db_Select::LIMIT_OFFSET);
        $select->where('stock_status_idx.stock_status = ?', $value);
        $select->columns(
            [
                'count' => new \Zend_Db_Expr("COUNT(e.entity_id)")
            ]
        );

        return $collection->getConnection()->fetchOne($select);
    }
}
