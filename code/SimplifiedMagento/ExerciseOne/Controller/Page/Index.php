<?php

/**
 * Index controller.
 *
 * @package SimplifiedMagento
 * @author  vivek parmar <vivek@.com>
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace SimplifiedMagento\ExerciseOne\Controller\Page;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\NotFoundException;

/**
 * Exerciseone index page controller.
 */
class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * Constructor
     *
     * @param Context $context //context
     */
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    /**
     * Execute 
     *
     * @return void
     */
    public function execute()
    {
        // TODO : Implement execute() method.
    }

    /**
     * Dispatch request
     *
     * @param RequestInterface $request //request
     *
     * @return ResponseInterface
     */
    public function dispatch(RequestInterface $request)
    {
        return parent::dispatch($request, "test");
    }
}