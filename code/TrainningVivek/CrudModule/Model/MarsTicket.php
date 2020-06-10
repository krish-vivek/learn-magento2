<?php

namespace TrainningVivek\CrudModule\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use TrainningVivek\CrudModule\Model\ResourceModel\MarsTicket as MarsTicketResource;
use TrainningVivek\CrudModule\Api\Data\MarsTicketInterface;

class MarsTicket extends AbstractExtensibleModel implements MarsTicketInterface
{
    protected function _construct() 
    {
    	$this->_init(MarsTicketResource::class);
    }

    /**
	 * @return int
	 */
	public function getId()
	{
		return $this->getData(MarsTicketInterface::ID);
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->getData(MarsTicketInterface::NAME);
	}

	/**
	 * @return boolean
	 */
	public function getStatus()
	{
		return $this->getData(MarsTicketInterface::STATUS);
	}

	/**
	 * @return string
	 */
	public function getTicketType()
	{
		return $this->getData(MarsTicketInterface::TICKET_TYPE);
	}

	/**
	 * @return string
	 */
	public function getTicketTags()
	{
		return $this->getData(MarsTicketInterface::TICKET_TAGS);
	}

	/**
	 * @return string
	 */
	public function getTicketLang()
	{
		return $this->getData(MarsTicketInterface::TICKET_LANG);
	}
	
	/**
	 * @return string
	 */
	public function getCreatedAt()
	{
		return $this->getData(MarsTicketInterface::CREATED_AT);
	}

	/**
	 * @return string
	 */
	public function getUpdatedAt()
	{
		return $this->getData(MarsTicketInterface::UPDATED_AT);
	}

	/**
	 * @param int $id
	 * @return \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface
	 */
	public function setId($id)
	{
		$this->setData(MarsTicketInterface::ID, $id);
	}

	/**
	 * @param string $name
	 * @return \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface
	 */
	public function setName($name)
	{
		$this->setData(MarsTicketInterface::NAME, $name);
	}

	/**
	 * @param boolean $status
	 * @return \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface
	 */
	public function setStatus($status)
	{
		$this->setData(MarsTicketInterface::STATUS, $status);
	}

	/**
	 * @param string $ticketType
	 * @return \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface
	 */
	public function setTicketType($ticketType)
	{
		$this->setData(MarsTicketInterface::TICKET_TYPE, $ticketType);
	}

	/**
	 * @param string $ticketTags
	 * @return \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface
	 */
	public function setTicketTags($ticketTags)
	{
		$this->setData(MarsTicketInterface::TICKET_TAGS, $ticketTags);
	}

	/**
	 * @param string $ticketLang
	 * @return \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface
	 */
	public function setTicketLang($ticketlang)
	{
		$this->setData(MarsTicketInterface::TICKET_LANG, $ticketlang);
	}

	/**
	 * @param string $createdAt
	 * @return \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface
	 */
	public function setCreatedAt($createdAt)
	{
		$this->setData(MarsTicketInterface::CREATED_AT, $createdAt);
	}

	/**
	 * @param string $updatedAt
	 * @return \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface
	 */
	public function setUpdatedAt($updatedAt)
	{
		$this->setData(MarsTicketInterface::UPDATED_AT, $updatedAt);
	}
}