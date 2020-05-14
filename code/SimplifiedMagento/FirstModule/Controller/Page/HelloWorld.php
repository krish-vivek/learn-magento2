<?php

/** Created By Vivek **/

namespace SimplifiedMagento\FirstModule\Controller\Page;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use SimplifiedMagento\FirstModule\Api\PencilInterface;

class HelloWorld extends \Magento\Framework\App\Action\Action
{
	protected $pencilInterface;
	protected $productRepository;

	public function __construct (Context $context, 
		PencilInterface $pencilInterface,
		ProductRepositoryInterface $productRepository
	)
	{
		$this->pencilInterface = $pencilInterface;
		$this->productRepository = $productRepository;
		parent::__construct($context);
	}

	/**
	 * Execute action based on request and return result
	 * 
	 * Note: Request will be added as operation argument in future
	 *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
	public function execute()
	{
		// TODO : Implement execute() method.
		echo "Hello World".'<br>';

		echo $this->pencilInterface->getPancilType().'<br>';

		echo get_class($this->productRepository);


	}
}