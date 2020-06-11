<?php

namespace TrainningVivek\CrudModule\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface MarsTicketInterface extends ExtensibleDataInterface
{
	const NAME = "name";
	const ID = "ticket_id";
	const STATUS = "status";
	const TICKET_TYPE = "ticket_type";
	const TICKET_TAGS = "ticket_tags";
	const TICKET_LANG = "ticket_lang";
	const TICKET_DESCRIPTION = "ticket_description";
	const TICKET_COLOR = "ticket_color";
	const CREATED_AT = "created_at";
	const UPDATED_AT = "updated_at";

	/**
	 * @return int
	 */
	public function getId();

	/**
	 * @return string
	 */
	public function getName();

	/**
	 * @return boolean
	 */
	public function getStatus();

	/**
	 * @return string
	 */
	public function getTicketType();

	/**
	 * @return string
	 */
	public function getTicketTags();

	/**
	 * @return string
	 */
	public function getTicketLang();

	/**
	 * @return string
	 */
	public function getTicketDescription();

	/**
	 * @return string
	 */
	public function getTicketColor();
	
	/**
	 * @return string
	 */
	public function getCreatedAt();

	/**
	 * @return string
	 */
	public function getUpdatedAt();

	/**
	 * @param int $id
	 * @return \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface
	 */
	public function setId($id);

	/**
	 * @param string $name
	 * @return \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface
	 */
	public function setName($name);

	/**
	 * @param boolean $status
	 * @return \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface
	 */
	public function setStatus($status);

	/**
	 * @param string $ticketType
	 * @return \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface
	 */
	public function setTicketType($ticketType);

	/**
	 * @param string $ticketTags
	 * @return \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface
	 */
	public function setTicketTags($ticketTags);

	/**
	 * @param string $ticketLang
	 * @return \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface
	 */
	public function setTicketLang($ticketlang);

	/**
	 * @param string $ticketdescription
	 * @return \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface
	 */
	public function setTicketDescription($ticketdescription);

	/**
	 * @param string $ticketColor
	 * @return \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface
	 */
	public function setTicketColor($ticketColor);

	/**
	 * @param string $createdAt
	 * @return \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface
	 */
	public function setCreatedAt($createdAt);

	/**
	 * @param string $updatedAt
	 * @return \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface
	 */
	public function setUpdatedAt($updatedAt);
}