<?php

namespace TrainningVivek\ProductDailyDeal\Setup;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Eav\Model\Entity\Attribute\Source\Boolean;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Model\Entity\Attribute\Backend\Datetime;
use TrainningVivek\ProductDailyDeal\Model\Product\Attribute\Backend\DealTime;

class InstallData implements InstallDataInterface
{
	private $eavSetupFactory;

	public function __construct(EavSetupFactory $eavSetupFactory)
	{
		$this->eavSetupFactory = $eavSetupFactory;
	}
	/**
     * Installs data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
    	$setup->startSetup();

    	$eavSetup = $this->eavSetupFactory->create(['setup'=>$setup]);
    	$eavSetup->addAttribute(
    		\Magento\Catalog\Model\Product::ENTITY,
    		'deal_status',
    		[
    			'group' => 'General',
    			'type' => 'int',
    			'input' =>  'select',
                'visible' => true,
                'required' => false,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'searchable'=> false,
                'used_in_product_listing'=>true,
                'label' => 'Deal Status',
                'source'=> Boolean::class,
                'default' => 0
    		]
    	);

        $eavSetup = $this->eavSetupFactory->create(['setup'=>$setup]);
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'deal_time',
            [
                'group' => 'General',
                'type' => 'datetime',
                'input' =>  'date',
                'visible' => true,
                'required' => false,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'searchable'=> false,
                'used_in_product_listing'=>false,
                'label' => 'Deal Time',
                'backend' => DealTime::class
            ]
        );

    	$setup->endSetup();
    }
}