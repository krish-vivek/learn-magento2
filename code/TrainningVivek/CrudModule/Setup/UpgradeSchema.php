<?php

namespace TrainningVivek\CrudModule\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Db\Ddl\Table;

class UpgradeSchema implements UpgradeSchemaInterface
{

	/**
     * Upgrades DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
    	$setup->startSetup();

    	if(version_compare($context->getVersion(), '0.0.2', '<')) {

    		$setup->getConnection()->addColumn(
    			$setup->getTable('mars_ticket'),
    			'ticket_description',
    			['nullable' => false, 'type' => Table::TYPE_TEXT, 'comment' => 'Ticket Description']
    		);

            $setup->getConnection()->addColumn(
                $setup->getTable('mars_ticket'),
                'ticket_color',
                ['nullable' => false, 'type' => Table::TYPE_TEXT, 'comment' => 'Ticket Color']
            );
    	}

    	$setup->endSetup();
    }
}