<?php

namespace SimplifiedMagento\CustomAdmin\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Index extends Action
{
	protected $scopeConfig;

	public function __construct(ScopeConfigInterface $scopeConfig, Context $context)
	{
		$this->scopeConfig = $scopeConfig;
		parent::__construct($context);
	}

	public function execute()
	{
		echo $this->scopeConfig->getValue('Firstsection/Firstgroup/Firstfield');
		echo "<br>";
		print_r($this->scopeConfig->getValue('Firstsection/Firstgroup/Thirdfield'));
	}
}