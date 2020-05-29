<?php

/**
 * Plugin Around Eight.
 *
 * @package SimplifiedMagento
 * @author  vivek parmar <vivek@ktpl.com>
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace SimplifiedMagento\ExerciseOne\Plugin;

class PluginAroundEight
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
    public function aroundDispatch(
        \Magento\Framework\App\Action\Action $subject, 
        callable $proceed, 
        $arg
    ) {
        echo  "Before – 7".'<br>';
        echo  "&nbsp;&nbsp;"."Around – 9".'<br>';
        $arg = $proceed($arg);
        return $arg;
    }
}
