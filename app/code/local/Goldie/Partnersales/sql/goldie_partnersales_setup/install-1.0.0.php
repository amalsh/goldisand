<?php

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();
//create partners table
$table = $installer->getConnection()
    ->newTable($installer->getTable('goldie_partnersales/partners'))
    ->addColumn(
        'partner_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
         'auto_increment'=>true,
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary'  => true,
    ), 'Id(primary key columns)'
    )
    ->addColumn(
        'name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 150, array(
        'nullable' => false,
    ), 'name'
    )
    ->addColumn(
        'street_address', Varien_Db_Ddl_Table::TYPE_VARCHAR, 250, array(
        'nullable' => false,
    ), 'Street address'
    )
    ->addColumn(
        'address', Varien_Db_Ddl_Table::TYPE_VARCHAR, 250, array(
        'nullable' => false,
    ), 'Address'
    )
    ->addColumn(
        'contact_no', Varien_Db_Ddl_Table::TYPE_VARCHAR, 12, array(
        'nullable' => false,
    ), 'Contact no'
    )
    ->addColumn(
        'email', Varien_Db_Ddl_Table::TYPE_VARCHAR, 250, array(
        'nullable' => false,
    ), 'email address'
    );
$installer->getConnection()->createTable($table);

//adding custom column to  sales order grid
$this->getConnection()->addColumn(
    $this->getTable('sales/order_grid'),
    'partner_name',
    'varchar(255) DEFAULT NULL'
);
$installer->endSetup();