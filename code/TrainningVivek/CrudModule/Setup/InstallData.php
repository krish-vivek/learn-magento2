<?php

namespace TrainningVivek\CrudModule\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
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

    	$setup->getConnection()->insert(
    		$setup->getTable('mars_ticket'),
    		['name' => 'Ticket-1', 'status' => true, 'ticket_type' => 1, 'ticket_tags' => 'tag1, tag2','ticket_lang' => '1, 2']
    	);

    	$setup->getConnection()->insert(
    		$setup->getTable('mars_ticket'),
    		['name' => 'Ticket-2', 'status' => false, 'ticket_type' => 2, 'ticket_tags' => 'tag1,tag2','ticket_lang' => '1']
    	);

    	$setup->endSetup();
    }
}