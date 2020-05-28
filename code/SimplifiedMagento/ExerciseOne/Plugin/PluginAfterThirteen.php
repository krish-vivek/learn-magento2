<?php

namespace SimplifiedMagento\ExerciseOne\Plugin;

class PluginAfterThirteen
{
    public function afterDispatch(\Magento\Framework\App\Action\Action $subject, $result)
    {
        return $result;
    }
}