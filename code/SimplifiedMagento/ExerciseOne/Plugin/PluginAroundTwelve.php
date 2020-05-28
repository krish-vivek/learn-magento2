<?php

namespace SimplifiedMagento\ExerciseOne\Plugin;

class PluginAroundTwelve
{
    public function aroundDispatch(\Magento\Framework\App\Action\Action $subject, callable $proceed, $arg)
    {
    	echo  "&nbsp;&nbsp;"."Around – 12".'<br>';
    	$arg = $proceed($arg);
        return $arg;
    }
}