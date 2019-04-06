<?php

/***
 * Partner sales capture observer
 *
 * Class Goldie_Partnersales_Model_Observer
 */
class Goldie_Partnersales_Model_Observer extends Varien_Event_Observer
{

    /***
     * Set partner cookies when controller before load
     */
    public function setPartnerCookie(Varien_Event_Observer $observer)
    {

        $partnerId = null;
        $partnerId = Mage::app()->getRequest()->getParam('partner');
        //if only parameter exists set cookies
        if ($partnerId != null) {

            Mage::helper('goldie_partnersales')->setPartnerCookie($partnerId);
        }

    }

    /***
     * Split invoces and shipments
     *
     * @param $observer
     */
    public function partnerInvoiceCreator(Varien_Event_Observer $observer)
    {
        $oorderIds = [];
        $helper = Mage::helper('goldie_partnersales');
        //if only partner exists we need to split invoices
        if ($helper->hasPartnerExists()) {

            $orderIds = $observer->getEvent()->getOrderIds();
            if(count($orderIds)) {
                $order = Mage::getModel('sales/order')->load($orderIds[0]);
               $splitter = new Goldie_Partnersales_Model_Ordersplitter($order);
                $splitter->splitPartnerSales();
                //remove the cookie
                $helper->clearPartnerCookie();
            }
        }
    }

    /**
     * Adds column to admin customers grid
     *
     * @param Varien_Event_Observer $observer
     * @return Goldie_Partnersales_Model_Observer
     */
    public function appendCustomColumn(Varien_Event_Observer $observer)
    {
        $block = $observer->getBlock();
        if (!isset($block)) {
            return $this;
        }

        if ($block->getType() == 'adminhtml/sales_order_grid') {
            /* @var $block Mage_Adminhtml_Block_Customer_Grid */
            $block->addColumnAfter('partner_name', array(
                'header'    => 'Partner Name',
                'type'      => 'text',
                'index'     => 'partner_name',
            ), 'shipping_name');
        }
    }

    /***
     * Set value for custom grid attribute sales partner
     * @param Varien_Event_Observer $observer
     */
    public function salesOrderGridCollectionLoadBefore(Varien_Event_Observer $observer)
    {
        $collection = $observer->getOrderGridCollection();
        $select = $collection->getSelect();
        $select->joinLeft(array('order'=>$collection->getTable('sales/order')),
            'order.entity_id=main_table.entity_id',array('partner_name'=>'partner_name'));


    }
}