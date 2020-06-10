<?php

namespace TrainningVivek\CrudModule\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface MarsSearchResultInterface extends SearchResultsInterface
{
	/**
     * Get items list.
     *
     * @return \Magento\Framework\Api\ExtensibleDataInterface[]
     */
    public function getItems();

	/**
	 * @param array $items
	 * @return SearchResultsInterface
	 */
	public function setItem(array $item);
}