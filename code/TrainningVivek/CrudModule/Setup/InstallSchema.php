<?php

namespace TrainningVivek\CrudModule\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Db\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
	/**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
    	$setup->startSetup();
    	$table = $setup->getConnection()->newTable(
    		$setup->getTable('mars_ticket')
    	)->addColumn(
    			'ticket_id',
    			Table::TYPE_INTEGER,
    			null,
    			['identity' => true, 'nullable' => false, 'primary' => true],
    			'Ticket ID'
    		)->addColumn(
    			'name',
    			Table::TYPE_TEXT,
    			255,
    			['nullable' => false],
    			'Ticket Name'
    		)->addColumn(
    			'status',
    			Table::TYPE_BOOLEAN,
    			10,
    			['nullable' => false, 'default' => false],
    			'STATUS'
    		)->addColumn(
                'ticket_type',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Ticket Type'
            )->addColumn(
                'ticket_tags',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Ticket Tags'
            )->addColumn(
                'ticket_lang',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Ticket Language'
            )->addColumn(
    			'created_at',
    			Table::TYPE_TIMESTAMP,
    			null,
    			['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
    			'TIME CREATED'
    		)->addColumn(
    			'updated_at',
    			Table::TYPE_TIMESTAMP,
    			null,
    			['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE],
    			'TIME FOR UPDATE'
    		)->setComment(
    			'Mars Ticket table'
    		);
    	

    	$setup->getConnection()->createTable($table);

    	$setup->endSetup();
    }
}