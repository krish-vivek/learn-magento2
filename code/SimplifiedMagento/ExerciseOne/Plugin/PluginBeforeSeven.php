<?php

namespace SimplifiedMagento\ExerciseOne\Plugin;

class PluginBeforeSeven
{
	public function beforeDispatch(\Magento\Framework\App\Action\Action $subject) {
		echo "&nbsp;&nbsp;&nbsp;&nbsp;"."After - 13"."<br>";
		echo "========"."<br>";
	}
}