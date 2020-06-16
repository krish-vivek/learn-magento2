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

    public function __construct(CollectionFactory $collectionFactory, MarsTicketFactory $marsTicketFactory, MarsTicket $marsTicket, MarsSearchResultInterfaceFactory $resultInterfaceFactory, CollectionProcessor $collectionProcessor, \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,\Psr\Log\LoggerInterface $logger)
    {
        $this->collectionFactory = $collectionFactory;
        $this->marsTicketFactory = $marsTicketFactory;
        $this->marsTicket = $marsTicket;
        $this->resultInterfaceFactory = $resultInterfaceFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->productRepository = $productRepository;
        $this->logger = $logger;
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
        $collection = $this->marsTicketFactory->create()->getCollection();
        $collection = $collection->addFieldToFilter('ticket_id', $id);
        return $collection->getData();
    }

    /**
     * @param \TrainningVivek\CrudModule\Api\Data\MarsTicketInterface $ticket
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

     /**
     * Updates the specified product from the request payload.
     *
     * @api
     * @param mixed $products
     * @return boolean
     */
    public function updateProduct($products)
    {
        if (!empty($products)) {
            $error = false;
            foreach ($products as $product) {
                try {
                    $sku = $product['sku'];
                    $productObject = $this->productRepository->get($sku);
                    $qty = $product['qty'];
                    $is_in_stock = !empty($product['is_in_stock'])?$product['is_in_stock']:1;
                    $productObject->setStockData(['is_in_stock' => $is_in_stock, 'qty' => $qty]);
                    try {
                        $this->productRepository->save($productObject);
                    } catch (\Exception $e) {
                         throw new StateException(__('Cannot save product.'));
                    }
                } catch (\Magento\Framework\Exception\LocalizedException $e) {
                    $messages[] = $product['sku'].' =>'.$e->getMessage();
                    $error = true;
                }
            }
            if ($error) {
                $this->writeLog(implode(" || ",$messages));
                return false;
            }
        }
        return true;
    }
 
    /* log for an API */
    public function writeLog ($log) {
        $this->logger->info($log);
    }
}
