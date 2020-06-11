<?php

namespace TrainningVivek\CrudModule\Block\Adminhtml\Ticket\Edit;

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
		/** @var MarsTicket */
		$ticket = $this->registry->registry('ticket');
		return $ticket ? $ticket->getId() : null;
	}

	public function getUrl($route='', $param=[]) {
		return $this->urlBuilder->getUrl($route, $param);
	}
}