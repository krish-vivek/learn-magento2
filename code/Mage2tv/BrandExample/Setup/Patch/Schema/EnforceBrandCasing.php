<?php

namespace Mage2tv\BrandExample\Setup\Patch\Schema;

use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Framework\Setup\Patch\PatchInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Mage2tv\BrandExample\Setup\StoreRoutinesProvider;
use Magento\Framework\DB\Ddl\TriggerFactory;

class EnforceBrandCasing implements SchemaPatchInterface
{
	private $storeRoutinesProvider;

	private $schemaSetup;

	private $triggerFactory;

	public function __construct(StoreRoutinesProvider $storeRoutinesProvider, SchemaSetupInterface $schemaSetup, TriggerFactory $triggerFactory)
	{
		$this->triggerFactory = $triggerFactory;
		$this->storeRoutinesProvider = $storeRoutinesProvider;
		$this->schemaSetup = $schemaSetup;
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
    	return [];
    }

	/**
     * Get aliases (previous names) for the patch.
     *
     * @return string[]
     */
    public function getAliases() {
    	return [];
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
    public function apply() {

    	$db = $this->schemaSetup->getConnection();
    	if ($db instanceof Mysql) {
    		foreach ($this->storeRoutinesProvider->getStoredFunctionSql() as $sql) {
    			strpos(rtrim($sql, "; \n\t"), ';') <> false?
    				$db->multiQuery($sql):
    				$db->query($sql);
    		}

    		$this->createTriggerToEnforceConsistentCasing();
    	}
    }

    private function createTriggerToEnforceConsistentCasing(): void
    {
    	$trigger = $this->triggerFactory->create();
    	$db = $this->schemaSetup->getConnection();
    	foreach ([Trigger::EVENT_INSERT, Trigger::EVENT_UPDATE] as $event) {
    		$tableName = $this->schemaSetup->getTable('mage2tv_brand_example');
    		$triggerName = $db->getTriggerName($tableName, Trigger::TIME_BEFORE, $event);
    		$trigger->setName($triggerName);
    		$trigger->setTime(Trigger::TIME_BEFORE);
    		$trigger->setEvent($event);
    		$trigger->setTable($tableName);

    		$trigger->addStatement("SET
    			NEW.name = UVWORDS(NEW.name),
    			NEW.desciption = CONCATE(UCFIRST_WORD(NEW.desciption), ' ', BUT_FIRST_WORD(NEW.desciption))
    		");

    		$db->dropTrigger($triggerName);
    		$db->createTrigger($trigger);
    	}
    }
}