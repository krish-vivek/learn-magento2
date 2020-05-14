<?php

namespace SimplifiedMagento\FirstModule\Model;

use SimplifiedMagento\FirstModule\Api\PencilInterface;
use SimplifiedMagento\FirstModule\Api\Color;
use SimplifiedMagento\FirstModule\Api\Size; 

class Pencil implements PencilInterface
{
	protected $color;
	protected $size;

	public function __construct(Color $color, Size $size)
	{
		$this->color = $color;
		$this->size = $size;
	}

	public function getPancilType()
	{
		return "Pencil has ".$this->color->getColor()." color and ".$this->size->getSize()." size";
	}
}