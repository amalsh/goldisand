<?php

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();
//drop added column to sales order grid
$this->getConnection()->addColumn($installer->getTable('sales/order'),
    'partner_name',
    array(
        'type' => Varien_Db_Ddl_Table::TYPE_VARCHAR,
        'length'    => 255,
        'nullable' => true,
        'default' => null,
        'comment' => 'Partner name'
    )
);
//create partners order
$installer->getConnection()
    ->dropColumn($installer->getTable('sales/order_grid'),'partner_name');
$installer->endSetup();