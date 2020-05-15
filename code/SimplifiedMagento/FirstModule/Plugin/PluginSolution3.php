<?php

namespace SimplifiedMagento\FirstModule\Plugin;

class PluginSolution3
{
	public function beforeExecute(\SimplifiedMagento\FirstModule\Controller\Page\HelloWorld $subject) {
		echo "Before execute sort order 30";
	}

	public function afterExecute(\SimplifiedMagento\FirstModule\Controller\Page\HelloWorld $subject) {
		echo "After execute sort order 30";
	}

	public function aroundExecute(\SimplifiedMagento\FirstModule\Controller\Page\HelloWorld $subject, callable $proceed) {
		echo "Before proceed sort order 30";
		$proceed();
		echo "After proceed sort order 30";
	}
}