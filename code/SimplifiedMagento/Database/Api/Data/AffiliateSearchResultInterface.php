<?php

namespace SimplifiedMagento\Database\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface AffiliateSearchResultInterface extends SearchResultsInterface
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