<?php

namespace SimplifiedMagento\RequestFlow\Controller\Page;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\Result\Raw;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\Controller\Result\RedirectFactory;

class ResponseType extends Action
{
	protected $pageFactory;
	protected $jsonFactory;
	protected $raw;
	protected $forwardFactory;
	protected $redirectFactory;

	public function __construct(Context $context, PageFactory $pageFactory, JsonFactory $jsonFactory, Raw $raw, ForwardFactory $forwardFactory, RedirectFactory $redirectFactory) {
		$this->pageFactory = $pageFactory;
		$this->jsonFactory = $jsonFactory;
		$this->raw = $raw;
		$this->forwardFactory = $forwardFactory;
		$this->redirectFactory = $redirectFactory;
		parent::__construct($context);
	}


	public function execute()
	{
		//return $this->pageFactory->create();
		//return $this->jsonFactory->create()->setData(['key'=>'value','key2' => ['one','two']]);
		//$result = $this->raw->setContents("<b>Hello World</b>");
		//return $result;
		// $result = $this->forwardFactory->create();
		// $result->setModule('noroutefound')->setController('page')->forward('customnoroute');
		// return $result;

		$result = $this->redirectFactory->create();
		$result->setPath('noroutefound/page/customnoroute');
		return $result;
	}
}