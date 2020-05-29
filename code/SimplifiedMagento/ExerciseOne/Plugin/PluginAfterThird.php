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

class PluginAfterThird
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
        \SimplifiedMagento\ExerciseOne\Controller\Page\Index $subject, 
        $result
    ) {
        echo "&nbsp;&nbsp;&nbsp;&nbsp;".'After - 3'."<br>";
        return $result;
    }
}
