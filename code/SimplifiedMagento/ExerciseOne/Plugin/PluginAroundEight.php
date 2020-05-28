<?php

namespace SimplifiedMagento\ExerciseOne\Plugin;

class PluginAroundEight
{
    public function aroundDispatch(\Magento\Framework\App\Action\Action $subject, callable $proceed, $arg)
    {
    	echo  "Before – 7".'<br>';
    	echo  "&nbsp;&nbsp;"."Around – 9".'<br>';
    	$arg = $proceed($arg);
        return $arg;
    }
}