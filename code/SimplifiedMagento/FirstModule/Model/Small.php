<?php

namespace SimplifiedMagento\FirstModule\Model;

use SimplifiedMagento\FirstModule\Api\Size; 

class Small implements Size
{
	public function getSize()
	{
		return "Small";
	}
}