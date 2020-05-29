<?php

/**
 * Plugin Before Seven.
 *
 * @package SimplifiedMagento
 * @author  vivek parmar <vivek@ktpl.com>
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace SimplifiedMagento\ExerciseOne\Plugin;

class PluginBeforeSeven
{
    /**
     * Before Dispatch request
     *
     * @param RequestInterface $subject //request
     *
     * @return ResponseInterface
     */
    public function beforeDispatch(
        \Magento\Framework\App\Action\Action $subject
    ) {
        echo "&nbsp;&nbsp;&nbsp;&nbsp;"."After - 13"."<br>";
        echo "========"."<br>";
    }
}
