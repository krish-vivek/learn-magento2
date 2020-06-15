<?php

namespace TrainningVivek\CrudModule\Api;

interface MarsTicketRepositoryInterface
{
	/**
	 * @return \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface[]
	 */
	public function getList();

	/**
	 * @param int $id
	 * @return \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface
	 */
	public function getMarsTicketById($id);

	/**
	 * @param \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface $ticket
	 * @return \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface
	 */
	public function saveMarsTicket(\TrainningVivek\CrudModule\Api\Data\MarsTicketInterface $ticket);

	/**
	 * @param int $id
	 * @return void
	 */
	public function deleteById($id);

	/**
	 * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
	 * @return \TrainningVivek\CrudModule\Api\Data\MarsSearchResultInterface
	 */
	public function getSearchResultsList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

	/**
	 * @param \Magento\Catalog\Api\Data\ProductInterface $product
	 * @return void
	 */
	public function updateProduct(\Magento\Catalog\Api\Data\ProductInterface $product);

}