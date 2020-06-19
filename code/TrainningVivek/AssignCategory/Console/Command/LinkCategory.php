<?php

namespace TrainningVivek\AssignCategory\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class LinkCategory extends Command
{
    protected $_productCollectionFactory;
        
    public function __construct(
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Api\CategoryLinkManagementInterface $categoryLinkManagement
    ) {    
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->categoryLinkManagement = $categoryLinkManagement;
        parent::__construct();
    }

    public function configure() {
        $this->setName('assigncategory:linkcategory');
        $this->setDescription('the command assign category to product');
        parent::configure();
    }

    public function execute(InputInterface $input, OutputInterface $output) {

        $fromDate = date('Y-m-d H:i:s', strtotime('-3 days'));
        $toDate = date('Y-m-d H:i:s', time());
        $collection = $this->_productCollectionFactory->create();
        $collection = $collection->addFieldToFilter('created_at', array('from' => $fromDate, 'to' => $toDate));
        //$collection->setPageSize(); // fetching only 3 products
        if (!empty($collection->getData())) {
            foreach ($collection->getData() as $key => $value) {
                $this->categoryLinkManagement->assignProductToCategories(
                    $value['sku'],
                    ['41']
                );
                $output->writeln("Category 41 is assign to product ".$value['sku']);
            }
        }
    }
}