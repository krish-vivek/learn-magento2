<?php
/** 
 * 
 * Copyright © 2019 Magento. All rights reserved. 
 * See COPYING.txt for license details. 
 */
namespace Unit1\Test\Plugin;

/** 
 * Class BeforeBreadcrumbsPlugin 
 * @package Unit1\Test\Plugin 
 */
class BeforeBreadcrumbsPlugin
{
	/**     
	* @param \Magento\Theme\Block\Html\Breadcrumbs $subject     
	* @param $crumbName
	* @param $crumbInfo
	* @return array     
	*/
	public function beforeAddCrumb(\Magento\Theme\Block\Html\Breadcrumbs $subject, $crumbName, $crumbInfo)    
	{        
		$crumbInfo['label'] = $crumbInfo['label'].'(!b)';
		return [$crumbName, $crumbInfo];
	}
}