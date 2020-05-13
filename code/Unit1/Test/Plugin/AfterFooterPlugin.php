<?php
/** 
 * 
 * Copyright © Magento. All rights reserved. 
 * See COPYING.txt for license details. 
 */

namespace Unit1\Test\Plugin;

/** 
  * Class AfterFooterPlugin 
  * @package Unit1\Test\Plugin 
  */

class AfterFooterPlugin {

	/**     
	  * @param \Magento\Theme\Block\Html\Footer $subject
	  * @param $result
	  * @return string
	  */
	public function afterGetCopyright(\Magento\Theme\Block\Html\Footer $subject, $result)
	{
		return 'Customized copyright!';
	}
} 