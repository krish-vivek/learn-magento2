<?php

namespace SimplifiedMagento\ExerciseOne\Plugin;

class PluginAroundFive
{
    public function aroundDispatch(\SimplifiedMagento\ExerciseOne\Controller\Page\Index $subject, callable $proceed, $arg)
    {	
    	echo  "Before – 4".'<br>';
    	echo  "&nbsp;&nbsp;"."Around – 5".'<br>';
    	$arg = $proceed($arg);
        return $arg;
    }
}