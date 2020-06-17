<?php

namespace TrainningVivek\LoginIpRestriction\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use TrainningVivek\LoginIpRestriction\Model\ResourceModel\LoggingLog as LoggingLogResource;
use TrainningVivek\LoginIpRestriction\Api\Data\LoggingLogInterface;

class LoggingLog extends AbstractExtensibleModel implements LoggingLogInterface
{
    protected function _construct() 
    {
    	$this->_init(LoggingLogResource::class);
    }

    /**
	 * @return int
	 */
	public function getId()
	{
		return $this->getData(LoggingLogInterface::ID);
	}

	/**
	 * @return string
	 */
	public function getEmail()
	{
		return $this->getData(LoggingLogInterface::EMAIL);
	}

	/**
	 * @return string
	 */
	public function getIp()
	{
		return $this->getData(LoggingLogInterface::IP);
	}

	/**
	 * @return int
	 */
	public function getEntityId()
	{
		return $this->getData(LoggingLogInterface::ENTITYID);
	}
	
	/**
	 * @return string
	 */
	public function getCreatedAt()
	{
		return $this->getData(LoggingLogInterface::CREATED_AT);
	}

	/**
	 * @return string
	 */
	public function getUpdatedAt()
	{
		return $this->getData(LoggingLogInterface::UPDATED_AT);
	}

	/**
	 * @param int $id
	 * @return \TrainningVivek\LoginIpRestriction\Api\Data\LoggingLogInterface
	 */
	public function setId($id)
	{
		$this->setData(LoggingLogInterface::ID, $id);
	}

	/**
	 * @param string $name
	 * @return \TrainningVivek\LoginIpRestriction\Api\Data\LoggingLogInterface
	 */
	public function setEmail($email)
	{
		$this->setData(LoggingLogInterface::EMAIL, $email);
	}

	/**
	 * @param string $ip
	 * @return \TrainningVivek\LoginIpRestriction\Api\Data\LoggingLogInterface
	 */
	public function setIp($ip)
	{
		$this->setData(LoggingLogInterface::IP, $ip);
	}

	/**
	 * @param int $entityId
	 * @return \TrainningVivek\LoginIpRestriction\Api\Data\LoggingLogInterface
	 */
	public function setEntityId($entityId)
	{
		$this->setData(LoggingLogInterface::ENTITYID, $entityId);
	}

	/**
	 * @param string $createdAt
	 * @return \TrainningVivek\LoginIpRestriction\Api\Data\LoggingLogInterface
	 */
	public function setCreatedAt($createdAt)
	{
		$this->setData(LoggingLogInterface::CREATED_AT, $createdAt);
	}

	/**
	 * @param string $updatedAt
	 * @return \TrainningVivek\LoginIpRestriction\Api\Data\LoggingLogInterface
	 */
	public function setUpdatedAt($updatedAt)
	{
		$this->setData(LoggingLogInterface::UPDATED_AT, $updatedAt);
	}
}