<?php

namespace SimplifiedMagento\Database\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use SimplifiedMagento\Database\Model\ResourceModel\AffiliateMember as AffiliateMemberResource;
use SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface;

class AffiliateMember extends AbstractExtensibleModel implements AffiliateMemberInterface
{
    protected function _construct() 
    {
    	$this->_init(AffiliateMemberResource::class);
    }

    /**
	 * @return int
	 */
	public function getId()
	{
		return $this->getData(AffiliateMemberInterface::ID);
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->getData(AffiliateMemberInterface::NAME);
	}

	/**
	 * @return boolean
	 */
	public function getStatus()
	{
		return $this->getData(AffiliateMemberInterface::STATUS);
	}

	/**
	 * @return string
	 */
	public function getAddress()
	{
		return $this->getData(AffiliateMemberInterface::ADDRESS);
	}

	/**
	 * @return string
	 */
	public function getPhoneNumber()
	{
		return $this->getData(AffiliateMemberInterface::PHONE_NUMBER);
	}
	
	/**
	 * @return string
	 */
	public function getCreatedAt()
	{
		return $this->getData(AffiliateMemberInterface::CREATED_AT);
	}

	/**
	 * @return string
	 */
	public function getUpdatedAt()
	{
		return $this->getData(AffiliateMemberInterface::UPDATED_AT);
	}

	/**
	 * @param int $id
	 * @return \SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface
	 */
	public function setId($id)
	{
		$this->setData(AffiliateMemberInterface::ID, $id);
	}

	/**
	 * @param string $name
	 * @return \SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface
	 */
	public function setName($name)
	{
		$this->setData(AffiliateMemberInterface::NAME, $name);
	}

	/**
	 * @param boolean $status
	 * @return \SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface
	 */
	public function setStatus($status)
	{
		$this->setData(AffiliateMemberInterface::STATUS, $status);
	}

	/**
	 * @param string $phoneNumber
	 * @return \SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface
	 */
	public function setPhoneNumber($phoneNumber)
	{
		$this->setData(AffiliateMemberInterface::PHONE_NUMBER, $phoneNumber);
	}

	/**
	 * @param string $address
	 * @return \SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface
	 */
	public function setAddress($address)
	{
		$this->setData(AffiliateMemberInterface::ADDRESS, $address);
	}

	/**
	 * @param string $createdAt
	 * @return \SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface
	 */
	public function setCreatedAt($createdAt)
	{
		$this->setData(AffiliateMemberInterface::CREATED_AT, $createdAt);
	}

	/**
	 * @param string $updatedAt
	 * @return \SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface
	 */
	public function setUpdatedAt($updatedAt)
	{
		$this->setData(AffiliateMemberInterface::UPDATED_AT, $updatedAt);
	}

	/**
	 * @return \SimplifiedMagento\Database\Api\Data\AffiliateMemberExtensionInterface|null
	 */
	public function getExtensionAttributes()
	{
		return $this->_getExtensionAttributes();
	}

	/**
	 * @param SimplifiedMagento\Database\Api\Data\AffiliateMemberExtensionInterface $affiliateMemberExtension
	 * @return $this
	 */
	public function setExtensionAttributes(\SimplifiedMagento\Database\Api\Data\AffiliateMemberExtensionInterface $affiliateMemberExtension)
	{
		return $this->_setExtensionAttributes($affiliateMemberExtension);
	}
}