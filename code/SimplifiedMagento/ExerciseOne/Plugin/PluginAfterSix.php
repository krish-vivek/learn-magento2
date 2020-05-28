<?php

namespace SimplifiedMagento\ExerciseOne\Plugin;

class PluginAfterSix
{
    public function afterDispatch(\SimplifiedMagento\ExerciseOne\Controller\Page\Index $subject, $result)
    {
        return $result;
    }
}