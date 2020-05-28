<?php

namespace SimplifiedMagento\ExerciseOne\Plugin;

class PluginBeforeFour
{
    public function beforeDispatch(\SimplifiedMagento\ExerciseOne\Controller\Page\Index $subject, $result)
    {
    	echo "&nbsp;&nbsp;&nbsp;&nbsp;".'After - 10'."<br>";
    	echo "========"."<br>";
    }
}