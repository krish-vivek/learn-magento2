<?php

/**
 * Plugin Around Two.
 *
 * @package SimplifiedMagento
 * @author  vivek parmar <vivek@ktpl.com>
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace SimplifiedMagento\ExerciseOne\Plugin;

class PluginAroundTwo
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
        \SimplifiedMagento\ExerciseOne\Controller\Page\Index $subject, 
        callable $proceed, 
        $arg
    ) {
        echo  "Before – 1".'<br>';
        echo  "&nbsp;&nbsp;"."Around – 2".'<br>';
        $arg = $proceed($arg);
        return $arg;
    }
}
