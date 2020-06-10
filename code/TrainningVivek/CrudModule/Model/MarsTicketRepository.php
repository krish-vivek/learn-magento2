<?php

namespace TrainningVivek\CrudModule\Model;

use TrainningVivek\CrudModule\Api\MarsTicketRepositoryInterface;
use TrainningVivek\CrudModule\Model\ResourceModel\MarsTicket\CollectionFactory;
use TrainningVivek\CrudModule\Model\MarsTicketFactory;
use TrainningVivek\CrudModule\Model\ResourceModel\MarsTicket;
use TrainningVivek\CrudModule\Api\Data\MarsSearchResultInterfaceFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessor;

class MarsTicketRepository implements MarsTicketRepositoryInterface
{
	private $collectionFactory;
	private $marsTicketFactory;
	private $marsTicket;
	private $resultInterfaceFactory;
	private $collectionProcessor;

	public function __construct(CollectionFactory $collectionFactory, MarsTicketFactory $marsTicketFactory, MarsTicket $marsTicket, MarsSearchResultInterfaceFactory $resultInterfaceFactory, CollectionProcessor $collectionProcessor)
	{
		$this->collectionFactory = $collectionFactory;
		$this->marsTicketFactory = $marsTicketFactory;
		$this->marsTicket = $marsTicket;
		$this->resultInterfaceFactory = $resultInterfaceFactory;
		$this->collectionProcessor = $collectionProcessor;
	}

	/**
	 * @return \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface[]
	 */
	public function getList()
	{
		return $this->collectionFactory->create()->getItems();
	}

	/**
	 * @param int $id
	 * @return \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface
	 */
	public function getMarsTicketById($id)
	{
		$ticket = $this->marsTicketFactory->create();
		return $ticket->load($id);
	}

	/**
	 * @param \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface $$ticket
	 * @return \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface
	 */
	public function saveMarsTicket(\TrainningVivek\CrudModule\Api\Data\MarsTicketInterface $ticket)
	{
		if ($ticket->getId() == null) {
			$this->marsTicket->save($ticket);
			return $ticket;
		} else {
			$newTicket = $this->marsTicketFactory->create()->load($ticket->getId());
			foreach ($ticket->getData() as $key => $value) {
				$newTicket->setData($key, $value);
			}
			$this->marsTicket->save($newTicket);
			return $newTicket;
		}
	}

	/**
	 * @param int $id
	 * @return void
	 */
	public function deleteById($id) {
		$ticket = $this->marsTicketFactory->create()->load($id);
		$ticket->delete();
	}

	/**
	 * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
	 * @return \TrainningVivek\CrudModule\Api\Data\MarsSearchResultInterface
	 */
	public function getSearchResultsList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
	{
		$collection = $this->marsTicketFactory->create()->getCollection();
		$this->collectionProcessor->process($searchCriteria, $collection);
		$searchResults = $this->resultInterfaceFactory->create();
		$searchResults->setSearchCriteria($searchCriteria);
		$searchResults->setItems($collection->getData());
		$searchResults->setTotalCount($collection->getSize());
		return $searchResults;
	}
}
