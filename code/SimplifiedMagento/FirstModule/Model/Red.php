<?php

namespace SimplifiedMagento\FirstModule\Model;

use SimplifiedMagento\FirstModule\Api\Color; 

class Red implements Color
{
	public function getColor()
	{
		return "Red";
	}
}