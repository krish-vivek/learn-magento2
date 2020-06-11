<?php

namespace TrainningVivek\CrudModule\Model;

use Magento\Framework\Option\ArrayInterface;

class AdminArray implements ArrayInterface
{
	/**
	  * Return array of options as value-label pairs
	  *
	  * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...) 
	  */
	public function toOptionArray()
	{
		return [
			['value' => 1, 'label' => __('Type 1')],
			['value' => 2, 'label' => __('Type 2')],
			['value' => 3, 'label' => __('Type 3')],
		];
	}
}