<?php

namespace SimplifiedMagento\ExerciseOne\Plugin;

class PluginAfterNine
{
    public function afterDispatch(\Magento\Framework\App\Action\Action $subject, $result)
    {
        return $result;
    }
}