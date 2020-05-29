<?php

/**
 * Plugin Before One.
 *
 * @package SimplifiedMagento
 * @author  vivek parmar <vivek@ktpl.com>
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace SimplifiedMagento\ExerciseOne\Plugin;

class PluginBeforeOne
{
    /**
     * Before Dispatch request
     *
     * @param RequestInterface $subject //request
     *
     * @return ResponseInterface
     */
    public function beforeDispatch(
        \SimplifiedMagento\ExerciseOne\Controller\Page\Index $subject
    ) {
        echo "&nbsp;&nbsp;&nbsp;&nbsp;".'After - 6'."<br>";
        echo "========"."<br>";
    }
}
