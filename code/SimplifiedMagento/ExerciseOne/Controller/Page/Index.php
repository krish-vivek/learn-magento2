<?php

/** Created By Vivek **/

namespace SimplifiedMagento\ExerciseOne\Controller\Page;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\App\Request\Http;

class Index extends \Magento\Framework\App\Action\Action
{

	protected $http;

	public function __construct (Context $context, Http $http)
	{
		$this->http = $http;
		parent::__construct($context);
	}

	/**
     * @return void
     */
	public function execute()
	{
		// TODO : Implement execute() method.
	}

	/**
     * Dispatch request
     *
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws NotFoundException
     */
    public function dispatch(RequestInterface $request)
    {
    	return parent::dispatch($request, "test");
    }
}