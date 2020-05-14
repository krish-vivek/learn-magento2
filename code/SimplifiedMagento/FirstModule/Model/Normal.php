<?php

namespace SimplifiedMagento\FirstModule\Model;

use SimplifiedMagento\FirstModule\Api\Size; 

class Normal implements Size
{
	public function getSize()
	{
		return "Normal";
	}
}