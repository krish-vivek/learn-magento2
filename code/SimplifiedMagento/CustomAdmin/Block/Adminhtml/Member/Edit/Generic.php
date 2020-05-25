<?php

namespace SimplifiedMagento\CustomAdmin\Block\Adminhtml\Member\Edit;

class Generic
{
	protected $urlBuilder;

	protected $registry;

	public function __construct(
		\Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry
	)
	{
		$this->urlBuilder = $context->getUrlBuilder();
		$this->registry = $registry;
	}

	public function getId()
	{
		/** @var AffiliateMember */
		$member = $this->registry->registry('member');
		return $member ? $member->getId() : null;
	}

	public function getUrl($route='', $param=[]) {
		return $this->urlBuilder->getUrl($route, $param);
	}
}