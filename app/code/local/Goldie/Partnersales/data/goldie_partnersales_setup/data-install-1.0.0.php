<?php

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$partners = array(
    array(
        'name'           => 'test partner A',
        'street_address' => 'Add 1',
        'address'        => 'Add 2',
        'contact_no'     => '1234566789',
        'email'          => 'test1@aaa.com',
    ),
    array(
        'name'           => 'test partner B',
        'street_address' => 'Add 3',
        'address'        => 'Add 4',
        'contact_no'     => '244232343324',
        'email'          => 'test2@bbb.com',
    ), array(
        'name'           => 'test partner C',
        'street_address' => 'Add 5',
        'address'        => 'Add 6',
        'contact_no'     => '34445555533',
        'email'          => 'test3@cccc.com',
    ),
);

//adding partners
foreach ($partners as $partner) {
    Mage::getModel('goldie_partnersales/partners')
        ->setData($partner)
        ->save();
}


$installer->endSetup();