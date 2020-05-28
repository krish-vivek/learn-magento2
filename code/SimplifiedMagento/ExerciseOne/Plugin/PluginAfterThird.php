<?php

namespace SimplifiedMagento\ExerciseOne\Plugin;

class PluginAfterThird
{
    public function afterDispatch(\SimplifiedMagento\ExerciseOne\Controller\Page\Index $subject, $result)
    {
    	echo "&nbsp;&nbsp;&nbsp;&nbsp;".'After - 3'."<br>";
        return $result;
    }
}