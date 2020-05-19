<?php

namespace SimplifiedMagento\FirstModule\Model;

use SimplifiedMagento\FirstModule\Api\Color; 

class Green implements Color
{
	public function getColor()
	{
		return "Green";
	}
}