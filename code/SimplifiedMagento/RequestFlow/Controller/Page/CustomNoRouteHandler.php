<?php

namespace SimplifiedMagento\RequestFlow\Controller\Page;

class CustonNoRouteHandler implements \Magento\Framework\App\Router\NoRouteHandlerInterface
{
	public function process(\Magento\Framework\App\RequestInterface $request)
	{
		$request->setRouteName('noroutefound')->setControllerName('page')->setActionName('customnoroute');

        return true;
	}
}