<?php

namespace SimplifiedMagento\ExerciseOne\Plugin;

class PluginBeforeEleven
{
	public function beforeDispatch(\Magento\Framework\App\Action\Action $subject) {
		echo "Before - 11"."<br>";
	}
}