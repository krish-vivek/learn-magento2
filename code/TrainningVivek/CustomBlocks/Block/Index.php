<?php

namespace TrainningVivek\CustomBlocks\Block;

use Magento\Framework\View\Element\Template;

class Index extends Template
{
    protected $collectionFactory;

    public function __construct(
        Template\Context $context, array $data=[])
    {
        parent::__construct($context, $data);
    }
}