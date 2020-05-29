<?php

/**
 * Plugin After Third.
 *
 * @package SimplifiedMagento
 * @author  vivek parmar <vivek@ktpl.com>
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace SimplifiedMagento\ExerciseOne\Plugin;

class PluginAfterThirteen
{
    /**
     * After Dispatch request
     *
     * @param RequestInterface $subject //request
     * @param $result  //result
     *
     * @return ResponseInterface
     */
    public function afterDispatch(
        \Magento\Framework\App\Action\Action $subject,
        $result
    ) {
        return $result;
    }
}
