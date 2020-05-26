<?php

namespace Mage2tv\BrandExample\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchInterface;

class InitializeDefaultBrands implements DataPatchInterface
{
	private $moduleDataSetup;

	public function __construct(ModuleDataSetupInterface $moduleDataSetup)
	{
		$this->moduleDataSetup = $moduleDataSetup;
	}
    
	/**
     * Get array of patches that have to be executed prior to this.
     *
     * Example of implementation:
     *
     * [
     *      \Vendor_Name\Module_Name\Setup\Patch\Patch1::class,
     *      \Vendor_Name\Module_Name\Setup\Patch\Patch2::class
     * ]
     *
     * @return string[]
     */
    public static function getDependencies() {
    	return [
    		\Magento\Store\Setup\Patch\Schema\InitializeStoresAndWebsites::class
    	];
    }

	/**
     * Get aliases (previous names) for the patch.
     *
     * @return string[]
     */
    public function getAliases()
    {
    	return [
    		Mage2tv\BrandExample\Setup\Patch\Data\CreateDefaultBrands::class
    	];
    }

    /**
     * Run code inside patch
     * If code fails, patch must be reverted, in case when we are speaking about schema - then under revert
     * means run PatchInterface::revert()
     *
     * If we speak about data, under revert means: $transaction->rollback()
     *
     * @return $this
     */
    public function apply()
    {
    	$brands = [
    		['name' => 'Sike', 'desciption' => 'Something cool.'],
    		['name' => 'Luma', 'desciption' => 'Something not quite as cool.'],
    		['name' => 'Babidas', 'desciption' => 'To cool to care']
    	];

    	$records = array_map(function ($brands) {
    		return array_merge($brands, ['is_enabled' => 1, 'website_id' => 1]);
    	}, $brands);

    	$this->moduleDataSetup->getConnection()->insertMultiple('mage2tv_brand_example', $records);

    	return $this;
    }
}