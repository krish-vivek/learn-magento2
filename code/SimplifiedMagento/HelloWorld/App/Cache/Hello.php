<?php

namespace SimplifiedMagento\HelloWorld\App\Cache;

use Magento\Framework\App\Cache\Type\FrontendPool;
use Magento\Framework\Cache\Frontend\Decorator\TagScope;
use Magento\Framework\Config\CacheInterface;

class Hello extends TagScope implements CacheInterface 
{
	const TYPE_IDENTIFIER = "Hello";

	const CACHE_TAG = "HELLO";

	public function __construct(FrontendPool $frontendPool)
	{
		parent::__construct($frontendPool->get(self::TYPE_IDENTIFIER), self::CACHE_TAG);
	}
}