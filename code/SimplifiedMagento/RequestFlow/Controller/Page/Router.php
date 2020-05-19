<?php

namespace SimplifiedMagento\RequestFlow\Controller\Page;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ActionFactory;

class Router implements \Magento\Framework\App\RouterInterface
{
	protected $actionFactory;

	public function __construct(ActionFactory $actionFactory) {
		$this->actionFactory = $actionFactory;
	}

	public function match(RequestInterface $request) {
		
		// /customer/account/login
		$path = trim($request->getPathInfo(),'/');
		$paths = explode('-', $path);
		if (!empty($paths[0]) && !empty($paths[1]) && !empty($paths[2])) {
			$request->setModuleName($paths[0]);
			$request->setControllerName($paths[1]);
			$request->setActionName($paths[2]);

			return $this->actionFactory->create('Magento\Framework\App\Action\Forward',['request' => $request]);
		}

		

	}
}