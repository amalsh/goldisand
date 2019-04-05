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
        //if only partner exists we need to split invoices
        if (Mage::helper('goldie_partnersales')->hasPartnerExists()) {
            $partnerName = Mage::helper('goldie_partnersales')->getCookiePartnerName();
            $orderIds = $observer->getEvent()->getOrderIds();
            if(count($oorderIds)) {
                $order = Mage::getSingleton('sales/order')->load($orderIds[0]);
                $splitter = new Goldie_Partnersales_Model_Ordersplitter($order);
                $splitter->splitPartnerSales();
                //set partner name to the grid
                $order->setPartnerName($partnerName);
                $order->save();
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
}