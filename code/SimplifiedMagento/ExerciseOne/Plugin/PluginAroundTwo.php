<?php

namespace SimplifiedMagento\ExerciseOne\Plugin;

class PluginAroundTwo
{
    public function aroundDispatch(\SimplifiedMagento\ExerciseOne\Controller\Page\Index $subject, callable $proceed, $arg)
    {
    	echo  "Before – 1".'<br>';
    	echo  "&nbsp;&nbsp;"."Around – 2".'<br>';
    	$arg = $proceed($arg);
        return $arg;
    }
}