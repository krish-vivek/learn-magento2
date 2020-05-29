<?php

/**
 * Plugin Before Eleven.
 *
 * @package SimplifiedMagento
 * @author  vivek parmar <vivek@ktpl.com>
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace SimplifiedMagento\ExerciseOne\Plugin;

class PluginBeforeEleven
{
    /**
     * After Dispatch request
     *
     * @param RequestInterface $subject //request
     *
     * @return ResponseInterface
     */
    public function beforeDispatch(
        \Magento\Framework\App\Action\Action $subject
    ) {
        echo "Before - 11"."<br>";
    }
}
