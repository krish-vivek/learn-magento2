<?php

namespace SimplifiedMagento\Database\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface AffiliateMemberInterface extends ExtensibleDataInterface
{
	const NAME = "name";
	const ID = "entity_id";
	const STATUS = "status";
	const ADDRESS = "address";
	const PHONE_NUMBER = "phone_number";
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
	public function getAddress();

	/**
	 * @return string
	 */
	public function getPhoneNumber();
	
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
	 * @return \SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface
	 */
	public function setId($id);

	/**
	 * @param string $name
	 * @return \SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface
	 */
	public function setName($name);

	/**
	 * @param boolean $status
	 * @return \SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface
	 */
	public function setStatus($status);

	/**
	 * @param string $phoneNumber
	 * @return \SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface
	 */
	public function setPhoneNumber($phoneNumber);

	/**
	 * @param string $address
	 * @return \SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface
	 */
	public function setAddress($address);

	/**
	 * @param string $createdAt
	 * @return \SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface
	 */
	public function setCreatedAt($createdAt);

	/**
	 * @param string $updatedAt
	 * @return \SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface
	 */
	public function setUpdatedAt($updatedAt);

	/**
	 * @return \SimplifiedMagento\Database\Api\Data\AffiliateMemberExtensionInterface|null
	 */
	public function getExtensionAttributes();

	/**
	 * @param SimplifiedMagento\Database\Api\Data\AffiliateMemberExtensionInterface $affiliateMemberExtension
	 * @return $this
	 */
	public function setExtensionAttributes(\SimplifiedMagento\Database\Api\Data\AffiliateMemberExtensionInterface $affiliateMemberExtension);	
}