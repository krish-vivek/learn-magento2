<?php

namespace SimplifiedMagento\CustomAdmin\Block\Adminhtml\Member\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveButton implements ButtonProviderInterface
{
	public function getButtonData()
	{
		return [
			'label' => __('Save Member'),
            'class' => 'save primary',
            'sort_order' => 50
		];
	}
}