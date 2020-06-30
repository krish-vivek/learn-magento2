<?php

namespace TrainningVivek\WholesaleFastOrder\Block;

use Magento\Framework\View\Element\Template;

class Index extends Template
{
    /**
     * @var \Magento\Framework\View\Asset\Repository
     */
    protected $_assetRepo;

    public function __construct(
        Template\Context $context, 
        \Magento\Framework\View\Asset\Repository $assetRepo,
        array $data=[]
    )
    {
        $this->_assetRepo = $assetRepo;
        parent::__construct($context, $data);
    }

    /**
     * Retrieve base image url
     *
     * @return string|bool
     */
    public function getImageUrl()
    {
        $url = $this->_assetRepo->getUrl('TrainningVivek_WholesaleFastOrder::images/preloader.gif');
        return $url;
    }

    /**
     * @param string $asset
     * @return string
     */
    //This function will be used to get the css/js file.
    public function getAssetUrl($asset) {
        return $this->_assetRepo->createAsset($asset)->getUrl();
    }

    /**
     * Retrieve the form posting URL
     *
     * @return string
     */
    public function getProductUrl()
    {
        return $this->getUrl('quickorder/product_ajax/items');
    }
    
}