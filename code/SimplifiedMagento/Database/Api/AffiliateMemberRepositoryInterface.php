<?php

namespace SimplifiedMagento\Database\Api;

interface AffiliateMemberRepositoryInterface
{
	/**
	 * @return \SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface[]
	 */
	public function getList();

	/**
	 * @param int $id
	 * @return \SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface
	 */
	public function getAffiliateMemberById($id);

	/**
	 * @param \SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface $member
	 * @return \SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface
	 */
	public function saveAffiliateMember(\SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface $member);

	/**
	 * @param int $id
	 * @return void
	 */
	public function deleteById($id);

	/**
	 * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
	 * @return \SimplifiedMagento\Database\Api\Data\AffiliateSearchResultInterface
	 */
	public function getSearchResultsList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

}