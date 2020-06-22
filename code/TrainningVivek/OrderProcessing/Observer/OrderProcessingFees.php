<?php
namespace TrainningVivek\OrderProcessing\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class OrderProcessingFees implements ObserverInterface
{
    protected $scopeConfig;

    /**
     * @param Session $customerSession
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    public function execute(\Magento\Framework\Event\Observer $observer) {
        $orderProcessingEnable = $this->scopeConfig->getValue('order_procession_fees/order_processing/apply_fees');
        if ($orderProcessingEnable) {
            $item = $observer->getEvent()->getData('quote_item');
            $product = $observer->getEvent()->getData('product');
            $itemProId = $item->getProduct()->getId();
            $orderProcessing = $this->scopeConfig->getValue('order_procession_fees/order_processing/process_fee');
            if (!empty($orderProcessing)) {
                $extraPrice = ($product->getPrice()*$orderProcessing)/100;
                $custom_price = $product->getPrice() + $extraPrice;
                $item->setCustomPrice($custom_price);
                $item->setOriginalCustomPrice($custom_price);
                $item->getProduct()->setIsSuperMode(true);
            }
        }
        return $this;
    }

}