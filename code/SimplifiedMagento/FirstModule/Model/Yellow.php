<?php

namespace SimplifiedMagento\FirstModule\Model;

use SimplifiedMagento\FirstModule\Api\Color; 

class Yellow implements Color
{
	public function getColor()
	{
		return "Yellow";
	}
}