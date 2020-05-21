<?php

namespace SimplifiedMagento\HelloWorld\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;

class HelloView implements ArgumentInterface
{
	protected $product;

	public function __construct(
		ProductRepositoryInterface $productRepository)
	{
		$this->product = $productRepository;
	}

	public function getHelloWorld()
	{
		return "This is from custom block";
	}

	public function helloArray()
	{
		$array = [
			"good",
			"very good",
			"excellent"
		];

		return $array;
	}

	public function getProductName() {
		$product = $this->product->get('24-MB01');
		return $product->getName(); 
	}
}