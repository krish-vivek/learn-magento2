<?php

namespace TrainningVivek\LoginIpRestriction\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface LoggingLogInterface extends ExtensibleDataInterface
{
	const EMAIL = "email";
	const ID = "id";
	const IP = "ip";
	const ENTITYID = "entity_id";
	const CREATED_AT = "created_at";
	const UPDATED_AT = "updated_at";

    /**
	 * @return int
	 */
	public function getId();

	/**
	 * @return string
	 */
	public function getEmail();

	/**
	 * @return string
	 */
	public function getIp();

	/**
	 * @return int
	 */
	public function getEntityId();
	
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
	 * @return \TrainningVivek\LoginIpRestriction\Api\Data\LoggingLogInterface
	 */
	public function setId($id);

	/**
	 * @param string $name
	 * @return \TrainningVivek\LoginIpRestriction\Api\Data\LoggingLogInterface
	 */
	public function setEmail($email);

	/**
	 * @param string $ip
	 * @return \TrainningVivek\LoginIpRestriction\Api\Data\LoggingLogInterface
	 */
	public function setIp($ip);

	/**
	 * @param int $entityId
	 * @return \TrainningVivek\LoginIpRestriction\Api\Data\LoggingLogInterface
	 */
	public function setEntityId($entityId);

	/**
	 * @param string $createdAt
	 * @return \TrainningVivek\LoginIpRestriction\Api\Data\LoggingLogInterface
	 */
	public function setCreatedAt($createdAt);

	/**
	 * @param string $updatedAt
	 * @return \TrainningVivek\LoginIpRestriction\Api\Data\LoggingLogInterface
	 */
	public function setUpdatedAt($updatedAt);	
}