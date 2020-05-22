<?php

namespace SimplifiedMagento\Database\Model;

use SimplifiedMagento\Database\Api\AffiliateMemberRepositoryInterface;
use SimplifiedMagento\Database\Model\ResourceModel\AffiliateMember\CollectionFactory;
use SimplifiedMagento\Database\Model\AffiliateMemberFactory;
use SimplifiedMagento\Database\Model\ResourceModel\AffiliateMember;
use SimplifiedMagento\Database\Api\Data\AffiliateSearchResultInterfaceFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessor;

class AffiliateMemberRepository implements AffiliateMemberRepositoryInterface
{
	private $collectionFactory;
	private $affiliateMemberFactory;
	private $affiliateMember;
	private $resultInterfaceFactory;
	private $collectionProcessor;

	public function __construct(CollectionFactory $collectionFactory, AffiliateMemberFactory $affiliateMemberFactory, AffiliateMember $affiliateMember, AffiliateSearchResultInterfaceFactory $resultInterfaceFactory, CollectionProcessor $collectionProcessor)
	{
		$this->collectionFactory = $collectionFactory;
		$this->affiliateMemberFactory = $affiliateMemberFactory;
		$this->affiliateMember = $affiliateMember;
		$this->resultInterfaceFactory = $resultInterfaceFactory;
		$this->collectionProcessor = $collectionProcessor;
	}

	/**
	 * @return \SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface[]
	 */
	public function getList()
	{
		return $this->collectionFactory->create()->getItems();
	}

	/**
	 * @param int $id
	 * @return \SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface
	 */
	public function getAffiliateMemberById($id)
	{
		$member = $this->affiliateMemberFactory->create();
		return $member->load($id);
	}

	/**
	 * @param \SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface $member
	 * @return \SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface
	 */
	public function saveAffiliateMember(\SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface $member)
	{
		if ($member->getId() == null) {
			$this->affiliateMember->save($member);
			return $member;
		} else {
			$newMember = $this->affiliateMemberFactory->create()->load($member->getId());
			foreach ($member->getData() as $key => $value) {
				$newMember->setData($key, $value);
			}
			$this->affiliateMember->save($newMember);
			return $newMember;
		}
	}

	/**
	 * @param int $id
	 * @return void
	 */
	public function deleteById($id) {
		$member = $this->affiliateMemberFactory->create()->load($id);
		$member->delete();
	}

	/**
	 * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
	 * @return \SimplifiedMagento\Database\Api\Data\AffiliateSearchResultInterface
	 */
	public function getSearchResultsList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
	{
		$collection = $this->affiliateMemberFactory->create()->getCollection();
		$this->collectionProcessor->process($searchCriteria, $collection);
		$searchResults = $this->resultInterfaceFactory->create();
		$searchResults->setSearchCriteria($searchCriteria);
		$searchResults->setItems($collection->getData());
		$searchResults->setTotalCount($collection->getSize());
		return $searchResults;
	}
}
