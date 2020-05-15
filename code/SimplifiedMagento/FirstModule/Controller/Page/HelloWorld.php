<?php

/** Created By Vivek **/

namespace SimplifiedMagento\FirstModule\Controller\Page;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use SimplifiedMagento\FirstModule\Api\PencilInterface;
use SimplifiedMagento\FirstModule\Model\PencilFactory;
use Magento\Catalog\Model\ProductFactory;

class HelloWorld extends \Magento\Framework\App\Action\Action
{
	protected $pencilInterface;
	protected $productRepository;
	protected $pencilFactory;
	protected $ProductFactory;

	public function __construct (Context $context,
		ProductFactory $productFactory,
		PencilFactory $pencilFactory,
		PencilInterface $pencilInterface,
		ProductRepositoryInterface $productRepository
	)
	{
		$this->productFactory = $productFactory;
		$this->pencilInterface = $pencilInterface;
		$this->pencilFactory = $pencilFactory;
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
		echo "<pre>";

		// TODO : Implement execute() method.
		echo "Hello World".'<br>';

		// dependency injection
		echo "<b>Dependency Injection</b><br>";
		echo $this->pencilInterface->getPancilType().'<br>';

		//echo get_class($this->productRepository).'<br>';

		// learning purpose
		//How to pass argument with type object in dependency injection
		echo "<b>Virtual Type</b><br>";
		$objectManager = \Magento\Framework\App\objectManager::getInstance();
		$pencil = $objectManager->create('SimplifiedMagento\FirstModule\Model\Pencil');
		var_dump($pencil);

		//How to pass argument with type object in dependency injection
		echo "<b>Argument Type : Object</b><br>";
		$book = $objectManager->create('SimplifiedMagento\FirstModule\Model\Book');
		var_dump($book);

		// How to pass argument with type = string
		echo "<b>Argument Type : string,number</b><br>";
		$student = $objectManager->create('SimplifiedMagento\FirstModule\Model\Student');
		var_dump($student);

		echo "<b>use of factory class</b><br>";
		$pencilf = $this->pencilFactory->create(array("name" => "Bob", "school" => "Internation College"));
		var_dump($pencilf);

		// Before Plugin
		echo "<b>Before Plugin</b><br>";
		$product = $this->productFactory->create()->load(1);
		$product->setName("Iphone 6");
		$productName = $product->getName();
		echo $productName.'<br>';
		$productSku = $product->getIdBySku("24-UG01");
		echo $productSku."<br>";

		// Around Plugin

		echo "Main Function";

	}
}