<?php

namespace SimplifiedMagento\ExerciseOne\Plugin;

class PluginBeforeOne
{
    public function beforeDispatch(\SimplifiedMagento\ExerciseOne\Controller\Page\Index $subject, $result)
    {
    	echo "&nbsp;&nbsp;&nbsp;&nbsp;".'After - 6'."<br>";
    	echo "========"."<br>";
    }
}