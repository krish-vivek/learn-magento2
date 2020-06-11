<?php

namespace TrainningVivek\CrudModule\Block\Adminhtml\Ticket\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveAndContinueButton implements ButtonProviderInterface
{
	public function getButtonData()
	{
		return [
			'label' => __('Save And Continue'),
            'class' => 'save',
            'sort_order' => 40
		];
	}
}