<?php

/**
 * Plugin Around Twelve.
 *
 * @package SimplifiedMagento
 * @author  vivek parmar <vivek@ktpl.com>
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace SimplifiedMagento\ExerciseOne\Plugin;

class PluginAroundTwelve
{
    /**
     * After Dispatch request
     *
     * @param RequestInterface $subject //request
     * @param callable         $proceed //proceed
     * @param $arg     //arg
     *
     * @return ResponseInterface
     */
    public function aroundDispatch(\Magento\Framework\App\Action\Action $subject, 
        callable $proceed, 
        $arg
    ) {
        echo  "&nbsp;&nbsp;"."Around – 12".'<br>';
        $arg = $proceed($arg);
        return $arg;
    }
}
