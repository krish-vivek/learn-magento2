<?php

namespace SimplifiedMagento\Database\Controller\Page;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use SimplifiedMagento\Database\Model\AffiliateMemberFactory;

class Index extends Action
{
	protected $affiliateMemberFactory;

	public function __construct(Context $context, AffiliateMemberFactory $affiliateMemberFactory) 
    {
    	$this->affiliateMemberFactory = $affiliateMemberFactory;
    	parent::__construct($context);
    }

    public function execute()
    {
    	$affiliateMember = $this->affiliateMemberFactory->create();
    	// $member  = $affiliateMember->load(1);

    	// $member->setAddress('New Address');
    	// $member->save();
    	// var_dump($member->getData());

    	// $affiliateMember->addData(['name' => 'John', 'address' => 'a new address', 'status' => true, 'phone_number' => '0123456789']);
    	// $affiliateMember->save();

    	//$member  = $affiliateMember->load(8);
    	//$member->delete();

        $collection = $affiliateMember->getCollection()
                    ->addFieldToSelect(['name','status'])
                    ->addFieldToFilter('status',array('neq' => true)); 
        foreach ($collection as $key => $item) {
            echo "<pre>";
            print_r($item->getData());
            echo "<br>";
        }

    }
}